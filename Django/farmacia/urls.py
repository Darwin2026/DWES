from django.contrib import admin
from django.db import router
from django.urls import path, include
from rest_framework.routers import DefaultRouter

from .views import PacienteViewSet, RecetaViewSet

router = DefaultRouter()
router.register("pacientes", PacienteViewSet, basename="pacientes")
router.register("recetas", RecetaViewSet, basename="recetas")


urlpatterns = [
    path('api/', include(router.urls)),
]
