from django.db import models


class Paciente(models.Model):
    nombre = models.CharField(max_length=120)
    dni = models.CharField(max_length=20, unique=True)
    fecha_nacimiento = models.DateField()
    telefono = models.CharField(max_length=20, blank=True)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        ordering = ["nombre"]
        verbose_name = "paciente"
        verbose_name_plural = "pacientes"

    def __str__(self):
        return f"{self.nombre} ({self.dni})"


class HistorialMedico(models.Model):
    paciente = models.OneToOneField(
        Paciente,
        on_delete=models.CASCADE,
        related_name="historial"
    )
    alergias = models.CharField(max_length=255, blank=True)
    enfermedades_cronicas = models.CharField(max_length=255, blank=True)

    class Meta:
        verbose_name = "historial médico"
        verbose_name_plural = "historiales médicos"

    def __str__(self):
        return f"Historial de {self.paciente.nombre}"


class Medicamento(models.Model):
    nombre = models.CharField(max_length=150)
    descripcion = models.TextField(blank=True)
    precio = models.DecimalField(max_digits=8, decimal_places=2)
    stock = models.IntegerField()
    requiere_receta = models.BooleanField(default=False)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        ordering = ["nombre"]
        verbose_name = "medicamento"
        verbose_name_plural = "medicamentos"

    def __str__(self):
        return self.nombre


class Receta(models.Model):
    paciente = models.ForeignKey(
        Paciente,
        on_delete=models.CASCADE,
        related_name="recetas"
    )
    fecha = models.DateField()
    medico = models.CharField(max_length=120)
    observaciones = models.TextField(blank=True)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        ordering = ["-fecha"]
        verbose_name = "receta"
        verbose_name_plural = "recetas"

    def __str__(self):
        return f"Receta {self.id} - {self.paciente.nombre}"


class RecetaMedicamento(models.Model):
    receta = models.ForeignKey(
        Receta,
        on_delete=models.CASCADE,
        related_name="lineas"
    )
    medicamento = models.ForeignKey(
        Medicamento,
        on_delete=models.CASCADE,
        related_name="recetas"
    )
    dosis = models.CharField(max_length=50)
    frecuencia = models.CharField(max_length=50)
    duracion_dias = models.IntegerField()
    precio_unitario = models.DecimalField(max_digits=8, decimal_places=2)

    class Meta:
        verbose_name = "medicamento en receta"
        verbose_name_plural = "medicamentos en receta"
        ordering = ["receta", "id"]
        constraints = [
            models.UniqueConstraint(
                fields=["receta", "medicamento"],
                name="unique_medicamento_por_receta"
            )
        ]

    def __str__(self):
        return f"{self.medicamento.nombre} en receta {self.receta.id}"


# Create your models here.
