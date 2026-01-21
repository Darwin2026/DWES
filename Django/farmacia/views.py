from django.views.decorators.http import require_GET
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from .models import Paciente


class PacienteListAPIView(APIView):
    def get(self, request):
        pacientes = Paciente.objects.all()

        data = []
        for p in pacientes:
            data.append({
                "id": p.id,
                "nombre": p.nombre,
                "dni": p.dni,
                "fecha_nacimiento": p.fecha_nacimiento,
                "telefono": p.telefono
            })
            return Response(data)




class PacienteDetailAPIView(APIView):
    def get(self, request, pk):
        try:
            paciente = Paciente.objects.get(pk=pk)
        except Paciente.DoesNotExist:
            return Response({"error": "Paciente no existe"}, status=status.HTTP_404_NOT_FOUND)

        data = {
            "id": paciente.id,
            "nombre": paciente.nombre,
            "dni": paciente.dni,
            "fecha_nacimiento": paciente.fecha_nacimiento,
            "telefono": paciente.telefono,
        }
        return Response(data)

class PacienteCreateAPIView(APIView):
    def post(self,request):
        data = request.data

        required = ["nombre", "dni", "fecha_nacimiento"]
        for field in required:
            if field not in data:
                return Response({"error": "falta el campo field"}, status=status.HTTP_400_BAD_REQUEST)
        try:
            paciente = Paciente.objects.create(
                nombre= data["nombre"],
                dni = data["dni"],
                fecha_nacimiento = data["fecha_nacimiento"],
                telefono = data.get("telefono", "")
            )
        except Exception as e:
            return Response({"error": str(e)}, status=status.HTTP_400_BAD_REQUEST)
        return Response({
            "id": paciente.id,
            "nombre": paciente.nombre,
            "dni": paciente.dni,
            "fecha_nacimiento": paciente.fecha_nacimiento,
            "telefono": paciente.telefono
        }, status=status.HTTP_201_CREATED)