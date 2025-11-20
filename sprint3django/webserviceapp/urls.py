from django.urls import path
from . import views

urlpatterns = [
	path('libros/', views.devolver_libros, name='devolver_libros'),
	path('libros/<int:id_solicitado>', views.devolver_libro_por_id),
	path('libros/<int:libro_id>/comentarios', views.guardar_comentario),
]
