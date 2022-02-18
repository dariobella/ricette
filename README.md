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
    `name` CHAR(45) NOT NULL , 
    `ingredients` TEXT NULL , 
    `url` VARCHAR(500) NULL , 
    `description` TEXT NULL , 
    `type` SET('Colazione','Primo','Secondo','Dessert','Snack') NULL , 
    `hours` INT NULL , 
    `mins` INT NULL , 
    `userId` INT NOT NULL , 
    PRIMARY KEY (`id`)
);
```