from django.http import JsonResponse, Http404
from .models import Paciente
import json
from django.views.decorators.csrf import csrf_exempt


def paciente_list(request):
    """
    Devuelve la lista completa de pacientes en formato JSON.
    """
    data = list(Paciente.objects.values())
    return JsonResponse(data, safe=False)


def paciente_detail(request, id):
    """
    Devuelve el detalle de un paciente por ID.
    """
    try:
        paciente = Paciente.objects.get(pk=id)
        data = {
            "id": paciente.id,
            "nombre": paciente.nombre,
            "dni": paciente.dni,
            "fecha_nacimiento": paciente.fecha_nacimiento,
            "telefono": paciente.telefono,
            "created_at": paciente.created_at,
            "updated_at": paciente.updated_at,
        }
        return JsonResponse(data)
    except Paciente.DoesNotExist:
        raise Http404("Paciente no encontrado")

@csrf_exempt
def paciente_create(request):
    if request.method != "POST":
        return JsonResponse({"error": "Method no permitido"}, status=405)
    try:
        data = json.loads(request.body)
    except json.JSONDecodeError:
        return JsonResponse({"error": "Json no valido"}, status=400)

    required_fields = ["nombre", "dni", "fecha_nacimiento"]
    for field in required_fields:
        if field not in data:
            return JsonResponse({"error": "Field no valido"}, status=400)

    try:
        paciente = Paciente.objects.create(
            nombre=data["nombre"],
            dni=data["dni"],
            fecha_nacimiento=data["fecha_nacimiento"],
            telefono=data.get("telefono", ""),
        )
    except Exception as e:
        return JsonResponse({"error": str(e)}, status=400)
    return JsonResponse({
        "id": paciente.id,
        "nombre": paciente.nombre,
        "dni": paciente.dni,
        "fecha_nacimiento": paciente.fecha_nacimiento,
        "telefono": paciente.telefono,
    }, status=201)