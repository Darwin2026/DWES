def mostrarMenu():
    print("\n--- Menu del cajero automatico ---")
    print("1. consultar saldo")
    print("2. Ingresar pasta")
    print("3. retirar pasta")
    print("4. salir / vuelve con dinero")


def consultaSaldo(cuenta):
    print(f"\n saldo actual: {cuenta['saldo']:.2f} €")

def ingresaDinero(cuenta):
    while True:
        cantidad = input("¿Cuánto dinero deseas ingresar?")
        try:
            cantidad = float(cantidad)
            if cantidad > 0:
                cuenta['saldo'] += cantidad
                print(f"ingresaste {cantidad:.2f} €. Saldo actualizado: {cuenta['saldo']:.2f} € ")
                break
            else:
                print("La cantidad a ingresar debe ser mayor a 0€")
        except ValueError:
            print("Por favor, introduce solo valores numéricos positivos.")

def retirarDinero(cuenta):
    while True:
        
        cantidad = input("¿Cuánto dinero deseas retirar?")
        try:
            cantidad = float(cantidad)
            if cantidad <= 0:
                print("por favor solo cantidades reales positivas")
            elif cantidad > cuenta['saldo']:
                print("Saldo insuficiente para realizar la retirada.")
            else:
                cuenta['saldo'] -= cantidad
                print(f"has retirado {cantidad:.2f} €. saldo actual: {cuenta['saldo']:.2f} €")
                break
        

        except ValueError:
            print("introduce solo numeros mayores a 0. ")

def cajeroAutomatico():
    cuenta = {"nombre": "Darwin", "saldo": 45000.0}
    print(f"Bienvenido, {cuenta['nombre']}")

    while True:
        mostrarMenu()
        opcion = input("elige una opcion válida del menú")
        try:
            opcion = int(opcion)
            if opcion == 1:
                consultaSaldo(cuenta)
            elif opcion == 2:
                ingresaDinero(cuenta)
            elif opcion == 3:
                retirarDinero(cuenta)
            elif opcion == 4:
                print("Gracias por tu visita. Hasta pronto!!!!!")
                break
            else:
                print("Por favor, elige una opción válida entre 1 y 4.")
        except ValueError: 
            print("la opción elegida no es válida, vuelve a introducir opción. ")

cajeroAutomatico()
