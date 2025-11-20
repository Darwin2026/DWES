from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from .models import Tlibros, Tcomentarios, Tusuarios
import json
from datetime import datetime

def devolver_libros(request):
	lista = Tlibros.objects.all()
	respuesta_final = []

	for fila_sql in lista:
		diccionario = {}
		diccionario['id'] = fila_sql.id
		diccionario['nombre'] = fila_sql.nombre
		diccionario['autor'] = fila_sql.autor
		diccionario['imagen'] = fila_sql.url_imagen
		diccionario['año'] = fila_sql.año_publicacion
		respuesta_final.append(diccionario)
	return JsonResponse(respuesta_final, safe=False)

def devolver_libro_por_id(request, id_solicitado):
	try:
		fila_sql = Tlibros.objects.get(id=id_solicitado)
		diccionario = {
			'id': fila_sql.id,
			'nombre': fila_sql.nombre,
			'autor': fila_sql.autor,
			'imagen': fila_sql.url_imagen,
			'año': fila_sql.año_publicacion
		}
		return JsonResponse(diccionario)
	except Tlibros.DoesNotExist:
		return JsonResponse({'error': f'libro con ID {id_solicitado} no encontrado'})
@csrf_exempt
def guardar_comentario(request, libro_id):
    if request.method != 'POST':
        return JsonResponse({"error": "Método no permitido"}, status=405)

    try:
        # Decodificar JSON recibido
        json_peticion = json.loads(request.body)

        # Crear nuevo comentario
        comentario = Tcomentarios()
        comentario.comentario = json_peticion['nuevo_comentario']
        comentario.libro = Tlibros.objects.get(id=libro_id)

        # Si viene usuario_id en el JSON, lo asignamos
        if 'usuario_id' in json_peticion:
            comentario.usuario = Tusuarios.objects.get(id=json_peticion['usuario_id'])

        # Guardamos fecha actual
        comentario.fecha = datetime.now()

        comentario.save()

        return JsonResponse({"status": "ok"}, status=201)

    except Tlibros.DoesNotExist:
        return JsonResponse({"error": "Libro no encontrado"}, status=404)
    except Tusuarios.DoesNotExist:
        return JsonResponse({"error": "Usuario no encontrado"}, status=404)
    except KeyError:
        return JsonResponse({"error": "Falta el campo 'nuevo_comentario'"}, status=400)
# Create your views here.
