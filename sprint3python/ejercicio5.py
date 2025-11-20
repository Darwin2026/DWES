class Tarea:
    def __init__(self, titulo, descripcion):
        self.titulo = titulo
        self.descripcion = descripcion
        self.completada = False

    def mostrar_info(self):
        estado = "Completada" if self.completada else "Pendiente"
        return f"Título: {self.titulo} | Estado: {estado}"

    def marcar_completada(self):
        self.completada = True

    def editar(self, nuevo_titulo, nueva_descripcion):
        self.titulo = nuevo_titulo
        self.descripcion = nueva_descripcion


def main():
    tareas = []

    while True:
        print("\n📋 Menú de opciones:")
        print("1. Crear tarea")
        print("2. Mostrar todas las tareas")
        print("3. Marcar tarea como completada")
        print("4. Editar tarea")
        print("5. Eliminar tarea")
        print("6. Salir")

        opcion = input("Selecciona una opción (1-6): ")

        if opcion == "1":
            titulo = input("Título de la tarea: ")
            descripcion = input("Descripción de la tarea: ")
            nueva_tarea = Tarea(titulo, descripcion)
            tareas.append(nueva_tarea)
            print("✅ Tarea creada con éxito.")

        elif opcion == "2":
            if not tareas:
                print("📭 No hay tareas.")
            else:
                for tarea in tareas:
                    print(tarea.mostrar_info())

        elif opcion == "3":
            titulo_buscar = input("Título de la tarea a completar: ").lower()
            encontrada = False
            for tarea in tareas:
                if tarea.titulo.lower() == titulo_buscar:
                    tarea.marcar_completada()
                    print("✅ Tarea marcada como completada.")
                    encontrada = True
                    break
            if not encontrada:
                print("❌ Tarea no encontrada.")

        elif opcion == "4":
            titulo_buscar = input("Título de la tarea a editar: ").lower()
            for tarea in tareas:
                if tarea.titulo.lower() == titulo_buscar:
                    nuevo_titulo = input("Nuevo título: ")
                    nueva_descripcion = input("Nueva descripción: ")
                    tarea.editar(nuevo_titulo, nueva_descripcion)
                    print("✏️ Tarea editada con éxito.")
                    break
            else:
                print("❌ Tarea no encontrada.")

        elif opcion == "5":
            titulo_buscar = input("Título de la tarea a eliminar: ").lower()
            for tarea in tareas:
                if tarea.titulo.lower() == titulo_buscar:
                    tareas.remove(tarea)
                    print("🗑️ Tarea eliminada.")
                    break
            else:
                print("❌ Tarea no encontrada.")

        elif opcion == "6":
            print("👋 ¡Hasta luego!")
            break

        else:
            print("⚠️ Opción inválida. Intenta de nuevo.")


if __name__ == "__main__":
    main()
