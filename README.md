
# Application of Design Pattern STRATEGY

This is a practical example of applying the Design Pattern *Strategy*.
This example simulates a part of a virtual store, which it would have some external libs for calculating shipping from some companies such as: Correios, Fedex, DHL, TNT, etc.

**Aviso:** the shipping calculation in this example is not real, illustrative purposes only.

## To Review

Docs:  [Strategy Pattern](https://refactoring.guru/).

Tutorial:  YouTube channel [Código Fonte TV](https://youtu.be/WPdrnuSHAQs).

## Instalação

Added `Dockerfile` and `docker-compose.yml` to the project if you want to run PHP code in a containerized environment.

To run the container it is necessary to have Docker installed and just use the command:

```bash
docker-compose -f "docker-compose.yml" up -d --build
```
