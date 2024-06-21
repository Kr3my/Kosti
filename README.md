# 🌊 Kosti
> **Proyecto escolar para facilitar la almacenación de información**

# 🐟 Introducción

La gestión eficiente del almacenamiento de información en una lista desempeña un papel crucial en facilitar un acceso eficiente y cómodo a los datos necesarios. En un mundo donde la información fluye a una velocidad acelerada y la toma de decisiones informadas es fundamental, la organización y el almacenamiento de datos de manera estratégica se vuelven esenciales. Una lista bien estructurada permite almacenar y recuperar datos de manera rápida y precisa, ayudando a evitar la duplicidad y minimizando la posibilidad de errores.

Nuestro proyecto tiene cómo finalidad proporcionar ayuda al acceder a la información de manera más eficiente y rápida.

# 🐋 Características
*Aspectos útiles*

+ **Sistema de cuentas:** El sistema de cuentas nos permite aislar y asegurar la información de cada usuario independiente.

+ **Sistema de tableros:** Este sistema permitirá organizar toda la información del usuario en un set de cartas único.
  
+ **Sistema de cartas:** Esto sirve para poder dividir la información en distintas categorías, lo que puede ayudar al usuario a no perderse a la hora de conseguir información sobre un tema en específico.

+ **Sistema para remover y añadir:** Existirán botones para facilitar la gestión del tablero y de esta forma mantener organizada la información.
  
+ **Sistema de compartido:** Con esta funcionalidad podrás brindar la información de tu tablero a otras personas con fines colaborativos.

+ **Interfaz sencilla:** La interfaz cuenta con elementos bastante simples para no complicar su comprensión.

# 🐬 Instrucciones
## **Manual de usuario:**

+ En caso de contar con una cuenta activa, favor de introducir el usuario y contraseña que designó al crearla.
> ![image](https://github.com/NotFxeel/Kosti/assets/150699852/cff3a4e7-3fc6-4755-a542-8711e31c6b32)



+ En caso de no contar con una cuenta activa, introduzca un nombre de usuario y contraseña las cuales se asignarán a su nueva cuenta.
> ![image](https://github.com/NotFxeel/Kosti/assets/150699852/79665cb2-9c6d-43f9-8b76-c48a7bf244b4)


### **Dueño del tablero:**


+ Una vez iniciada la sesión podrá ver su tablero, listo para su uso.
+ Los botones adentro de las cartas permitirán crear nuevas cartas para almacenar información.
+ El botón del tablero permitirá agregar nuevas tablas para crear nuevas categorías de información.
+ Podrá modificar el nombre de la carta presionando el texto del encabezado.
+ Si deasea compartir su tablero a otras personas, puede presionar el botón de compartir, lo cual generará un enlace que se copiará al portapapeles listo para compartir. **Las personas que entren por el enlace no podrán hacer modificaciones en el tablero, sin embargo, podrán ver el tablero.**
> ![image](https://github.com/NotFxeel/Kosti/assets/150699852/f9cbcb39-93be-4bc2-a316-ab38861c0fcb)


### **Invitado:**
+ Cómo invitado, podrá ver y leer el tablero de la persona a la que esté observando
> ![image](https://github.com/NotFxeel/Kosti/assets/150699852/61bc04ae-4fc3-4950-9af5-5e14b26a5913)

# **Manual técnico:**

## **Configuración de la Base de datos:**
+ Para configurar la base de datos, es necesario crear tablas que se encuentran en el archivo [database.sql](https://github.com/NotFxeel/Kosti/blob/main/database.sql) en su base de datos MySQL.

## **Configuración de rutas** 

+ Las rutas son relativas, por lo que no debería de haber un problema a la hora de ejecutar el proyecto, pero si es necesario realizar modificaciones, puede modificar las rutas asignadas a la API dentro del directorio [scripts](https://github.com/NotFxeel/Kosti/tree/main/scripts) al lugar en el que se encuentren los archivos del directorio la [API]([https://github.com/NotFxeel/Kosti/tree/main/scripts](https://github.com/NotFxeel/Kosti/tree/main/api)). En caso de realizar cambios en el resto de rutas, también tendrán que realizarse modificaciones en el directorio de la [API]([https://github.com/NotFxeel/Kosti/tree/main/scripts](https://github.com/NotFxeel/Kosti/tree/main/api)).
