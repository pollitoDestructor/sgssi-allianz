# Proyecto Allianz Labubu

## Integrantes del grupo

- Shaman Alonso Amezcua
- Marcos Cobo Gutiérrez
- Alexander Díez Ortuzar 
- Gabriel Gutiérrez Portal
- Aritz de la Pinta Morales
- Keneth Sebastián Campos

## Despliegue del proyecto con Docker Compose

### Requisitos previos

#### Docker

Antes de comenzar, asegúrate de tener instalado:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

Puedes verificar que están instalados con:

```bash
docker -v
docker-compose -v
```

#### Repositorio

Asimismo, descargamos el repositorio con:

```bash
git clone -b entrega_1 https://github.com/pollitoDestructor/sgssi-allianz.git
```

### Ejecutar y detener el proyecto

#### Ejecutarlo

Hay que hacer uso del "docker-compose.yml" con:

```bash
docker-compose up
```

#### Detenerlo

```bash
docker-compose down
```
