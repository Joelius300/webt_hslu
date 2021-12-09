CREATE DATABASE mushrooms;

USE mushrooms;

CREATE TABLE mushroom
(
    id     INT          NOT NULL AUTO_INCREMENT, # ensure that we don't need to keep track of ids ourselves
    name   VARCHAR(100) NOT NULL,
    height INT          NOT NULL,
    color  VARCHAR(50)  NOT NULL,
    PRIMARY KEY (id)
);
# no unique constraints, you can record the same mushroom multiple times.
