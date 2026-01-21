from django.core.serializers import serialize
from django.views.decorators.http import require_GET
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from .models import Paciente
from .serializers import PacienteSerializer
from .serializers import PacienteSerializer


class PacienteListAPIView(APIView):
    def get(self, request):
        pacientes = Paciente.objects.all()
        serializer = PacienteSerializer(pacientes, many=True)
        return Response(serializer.data)

class PacienteDetailAPIView(APIView):
    def get(self, request, pk):
        try:
            paciente = Paciente.objects.get(pk=pk)
        except Paciente.DoesNotExist:
            return Response({"Error: paciente no existente"},
            status = status.HTTP_404_NOT_FOUND
            )

        serializer = PacienteSerializer(paciente)
        return Response(serializer.data)

class PacienteCreateAPIView(APIView):
    def post(self,request):
        serializer = PacienteSerializer(data = request.data)
        if serializer.is_valid():
            paciente = serializer.save()
            return Response(PacienteSerializer(paciente).data, status = status.HTTP_201_CREATED)

        return Response(serializer.errors, status = status.HTTP_400_BAD_REQUEST)
