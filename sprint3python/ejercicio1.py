import random

def elegirDificultad():
    while True:
        nivel = input("Introduce un nivel, facil, medio, alto:  ").lower()
        if nivel == "facil":
            return 30
        elif nivel == "medio":
            return 60
        elif nivel == "alto":
            return 100
        else: 
            print("nivel no válido, por favor solo valores válidos")

def jugar():
    print("adivina el numero segun nivel, segun intentos...")

    maximo = elegirDificultad()
    numSecreto = random.randint(1, maximo)
    numIntentos = 0

    while True:
        try:
            numero = int(input(f"adivina el numero entre 1 y {maximo}: "))
            numIntentos += 1
            if numero < numSecreto:
                print("demasiado bajo.\n")

            elif numero > numSecreto:
                print("Demasiado alto.\n")
            else:
                print(f"genial, acertaste el numero Secreto en {numIntentos} intentos.\n")
                break
        except ValueError:
            print("Entrada inválida por favor solo un número entero.")

def main():
    while True:
        jugar()
        while True:
            otra = input("Quieres jugar otra vez?").lower().strip()
            if otra == "s":
                print("Genial juguemos!!!")
                break #para salir del bucle
            elif otra == "n":
                print("Hasta pronto!!!!")
                return #para salir del programa.
            else:
                print("Introduce solo S o N")
                

main()