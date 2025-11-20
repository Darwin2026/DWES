listaCompra = [];

def menu():
    print("1. Añadir producto")
    print("2. Eliminar producto")
    print("3. Ver lista")
    print("4. Vaciar lista")
    print("5. Salir")

def añadirProducto(listaCompra):
        producto = input("introduce el nombre del producto").strip().lower()
        #.strip() para eliminar espacios
        #.lower() para convertir los caracteres a minusculas.
        if producto in listaCompra:
              print(f"El producto {producto} ya se encuentra en la lista.")
        else:
              listaCompra.append(producto)
              print(f"Producto {producto} añadido correctamente.")
     
        
def eliminarProducto(listaCompra):
        producto = input("Nombre del producto a eliminar.").strip().lower()
        if producto in listaCompra:
              listaCompra.remove(producto)
              print(f"Se ha eliminado el producto {producto} mencionado.")
        else:
              print(f"Producto {producto} no encontrado para eliminar.")

def ver_lista(listaCompra):
        if len(listaCompra) == 0:
               print("Lista vacía, añade productos para visualizar.")
        else:
               print("Lista de la compra: ")
               for producto in sorted(listaCompra):
                      print(f"· {producto}")


def vaciar_lista(listaCompra):
        confirmar = input("¿Deseas vaciar la lista de productos respues: s/n?").strip().lower()
        if confirmar == "s":
              listaCompra.clear()
              print("Acabas de Vacial la lista correctamente.")
        elif confirmar == "n":
              print("La lista no fue borrada.")
            
        else:
              print("Respuesta no valida.")


def gestor_compra(listacompra):
       print("Bienvenido a  tu gestor de la compra.")

       while True:
            menu()

            opcion = input("Introduce una opcion del menú que sea válida.")
            try:
                  opcion = int(opcion)
                  if opcion == 1:
                        añadirProducto(listaCompra)
                  elif opcion == 2:
                        eliminarProducto(listaCompra)
                  elif opcion == 3:
                        ver_lista(listaCompra)
                  elif opcion == 4:
                        vaciar_lista(listaCompra)
                  elif opcion == 5:
                        print("Hasta pronto!!!!.")
                        break
                  else:
                        print("Por favor elige un numero/opción del menú") 
            except ValueError:
                  print("solo introduce números positivos para elegir opción.")

gestor_compra([])
