# Documentazione Ricettario di Dario

## Creazione Database

### Tabella Users

```sql
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `username` CHAR(30) NOT NULL , 
    `psw` CHAR(41) NOT NULL , 
    PRIMARY KEY (`id`), 
    UNIQUE (`username`)
);
```

### Tabella Ricette

```sql
CREATE TABLE `recipes` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nome` CHAR(45) NOT NULL , 
    `ingredienti` TEXT NULL , 
    `url` VARCHAR(500) NULL , 
    `descrizione` TEXT NULL , 
    `tipo` SET('Colazione','Primo','Secondo','Dessert','Snack') NULL , 
    `ore` INT NULL , 
    `minuti` INT NULL , 
    `userId` INT NOT NULL , 
    PRIMARY KEY (`id`)
);

```