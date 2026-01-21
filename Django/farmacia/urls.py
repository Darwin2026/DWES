from django.contrib import admin
from django.urls import path
from .views import (
    PacienteListAPIView,
    PacienteDetailAPIView,
    PacienteCreateAPIView
)

urlpatterns = [
    path('api/pacientes/', PacienteListAPIView.as_view()),
    path('api/pacientes/<int:pk>/', PacienteDetailAPIView.as_view()),
    path('api/pacientes/create/', PacienteCreateAPIView.as_view()),
]
