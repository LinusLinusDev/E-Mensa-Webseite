-- create database

create database emensawerbeseite CHARACTER SET UTF8mb4 COLLATE utf8mb4_unicode_ci;

use emensawerbeseite;

-- create tables

create table allergen
(
    code char(4)                        not null
        primary key,
    name varchar(300)                   not null,
    typ  varchar(20) default 'allergen' not null
);

create table benutzer
(
    id                bigint auto_increment
        primary key,
    email             varchar(100)         not null,
    password          varchar(200)         not null,
    admin             tinyint(1) default 0 null,
    anzahlfehler      int        default 0 not null,
    anzahlanmeldungen int        default 0 not null,
    letzteanmeldung   datetime             null,
    letzterfehler     datetime             null,
    constraint email
        unique (email)
);

create table bewertung
(
    id                  bigint auto_increment
        primary key,
    bewertungszeitpunkt datetime             null,
    hervorheben         tinyint(1) default 0 null,
    sternebewertung     varchar(20)          null,
    bemerkung           varchar(500)         null,
    erstellerId         bigint               null,
    constraint bewertung_ibfk_1
        foreign key (erstellerId) references benutzer (id)
);

create index erstellerId
    on bewertung (erstellerId);

create table gericht
(
    id           bigint               not null
        primary key,
    name         varchar(80)          not null,
    beschreibung varchar(800)         not null,
    erfasst_am   date                 not null,
    vegetarisch  tinyint(1) default 0 not null,
    vegan        tinyint(1) default 0 not null,
    preis_intern double               not null,
    preis_extern double               not null,
    bildname     varchar(200)         null,
    constraint name
        unique (name),
    check (`preis_intern` <= `preis_extern`),
    constraint preis_extern
        check (`preis_extern` > 0),
    constraint preis_intern
        check (`preis_intern` > 0)
);

create index name_2
    on gericht (name);

create table bewertung_bewertet_gericht
(
    bewertungsid bigint null,
    gerichtid    bigint null,
    constraint bewertung_bewertet_gericht_ibfk_1
        foreign key (bewertungsid) references bewertung (id)
            on delete cascade,
    constraint bewertung_bewertet_gericht_ibfk_2
        foreign key (gerichtid) references gericht (id)
            on delete cascade
);

create index bewertungsid
    on bewertung_bewertet_gericht (bewertungsid);

create index gerichtid
    on bewertung_bewertet_gericht (gerichtid);

create table erstellerin
(
    email varchar(200)                  not null
        primary key,
    name  varchar(200) default 'anonym' not null
);

create table gericht_hat_allergen
(
    code       char(4) null,
    gericht_id bigint  not null,
    constraint gericht_hat_allergen_ibfk_3
        foreign key (gericht_id) references gericht (id)
            on delete cascade,
    constraint gericht_hat_allergen_ibfk_4
        foreign key (code) references allergen (code)
            on update cascade,
    constraint gericht_hat_allergen_ibfk_5
        foreign key (code) references allergen (code)
);

create index code
    on gericht_hat_allergen (code);

create index gericht_id
    on gericht_hat_allergen (gericht_id);

create table kategorie
(
    id        bigint       not null
        primary key,
    name      varchar(80)  not null,
    eltern_id bigint       null,
    bildname  varchar(200) null,
    constraint kategorie_ibfk_1
        foreign key (eltern_id) references kategorie (id)
);

create index eltern_id
    on kategorie (eltern_id);

create table gericht_hat_kategorie
(
    gericht_id   bigint not null,
    kategorie_id bigint not null,
    constraint gericht_id
        unique (gericht_id, kategorie_id),
    constraint gericht_hat_kategorie_ibfk_3
        foreign key (gericht_id) references gericht (id)
            on delete cascade,
    constraint gericht_hat_kategorie_ibfk_4
        foreign key (kategorie_id) references kategorie (id)
);

create index kategorie_id
    on gericht_hat_kategorie (kategorie_id);

alter table gericht_hat_kategorie
    add primary key (gericht_id, kategorie_id);

create table newsletter
(
    email      varchar(200) not null
        primary key,
    name       varchar(80)  not null,
    familyname varchar(80)  not null,
    lang       varchar(100) not null
);

create table visitors
(
    count bigint not null
);

create table wunschgericht
(
    nummer           bigint auto_increment
        primary key,
    erstellungsdatum date         not null,
    beschreibung     varchar(800) null,
    name             varchar(80)  not null,
    erstelltVonEmail varchar(200) null,
    constraint erstelltVonEmail
        unique (erstelltVonEmail),
    constraint wunschgericht_ibfk_1
        foreign key (erstelltVonEmail) references erstellerin (email)
);

-- fill tables

insert into allergen (code, name, typ)
values  ('a', 'Getreideprodukte', 'Getreide (Gluten)'),
        ('a1', 'Weizen', 'Allergen'),
        ('a2', 'Roggen', 'Allergen'),
        ('a3', 'Gerste', 'Allergen'),
        ('a4', 'Dinkel', 'Allergen'),
        ('a5', 'Hafer', 'Allergen'),
        ('a6', 'Dinkel', 'Allergen'),
        ('b', 'Fisch', 'Allergen'),
        ('c', 'Krebstiere', 'Allergen'),
        ('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
        ('e', 'Sellerie', 'Allergen'),
        ('f', 'Milch und Laktose', 'Allergen'),
        ('f1', 'Butter', 'Allergen'),
        ('f2', 'Käse', 'Allergen'),
        ('f3', 'Margarine', 'Allergen'),
        ('g', 'Sesam', 'Allergen'),
        ('h', 'Nüsse', 'Allergen'),
        ('h1', 'Mandeln', 'Allergen'),
        ('h2', 'Haselnüsse', 'Allergen'),
        ('h3', 'Walnüsse', 'Allergen'),
        ('i', 'Erdnüsse', 'Allergen');

insert into gericht (id, name, beschreibung, erfasst_am, vegetarisch, vegan, preis_intern, preis_extern, bildname)
values  (1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4, '01_bratkartoffel.jpg'),
        (3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4, '03_bratkartoffel.jpg'),
        (4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5, '04_tofu.jpg'),
        (5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5, null),
        (6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 1, 0, 2.5, 4.5, '06_lasagne.jpg'),
        (7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4, null),
        (8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4, null),
        (9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5, '09_suppe.jpg'),
        (10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5, '10_forelle.jpg'),
        (11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 1, 0, 2, 3, '11_soup.jpg'),
        (12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2, '12_kassler.jpg'),
        (13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 1, 0, 2.5, 4.5, '13_reibekuchen.jpg'),
        (14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 1, 0, 3, 5, null),
        (15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5, '15_pilze.jpg'),
        (16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 1, 0, 1, 1.5, null),
        (17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75, '17_broetchen.jpg'),
        (18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5, null),
        (19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 1, 0, 1.25, 1.75, '19_mousse.jpg'),
        (20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9, '20_suppe.jpg');

insert into gericht_hat_allergen (code, gericht_id)
values  ('h', 1),
        ('a3', 1),
        ('a4', 1),
        ('f1', 3),
        ('a6', 3),
        ('i', 3),
        ('a3', 4),
        ('f1', 4),
        ('a4', 4),
        ('h3', 4),
        ('d', 6),
        ('h1', 7),
        ('a2', 7),
        ('h3', 7),
        ('c', 7),
        ('a3', 8),
        ('h3', 10),
        ('d', 10),
        ('f', 10),
        ('f2', 12),
        ('h1', 12),
        ('a5', 12),
        ('c', 1),
        ('a2', 9),
        ('i', 14),
        ('f1', 1),
        ('a1', 15),
        ('a4', 15),
        ('i', 15),
        ('f3', 15),
        ('h3', 15);

insert into kategorie (id, name, eltern_id, bildname)
values  (1, 'Aktionen', null, 'kat_aktionen.png'),
        (2, 'Menus', null, 'kat_menu.gif'),
        (3, 'Hauptspeisen', 2, 'kat_menu_haupt.bmp'),
        (4, 'Vorspeisen', 2, 'kat_menu_vor.svg'),
        (5, 'Desserts', 2, 'kat_menu_dessert.pic'),
        (6, 'Mensastars', 1, 'kat_stars.tif'),
        (7, 'Erstiewoche', 1, 'kat_erties.jpg');

insert into gericht_hat_kategorie (gericht_id, kategorie_id)
values  (1, 3),
        (3, 3),
        (4, 3),
        (5, 3),
        (6, 3),
        (7, 3),
        (9, 3),
        (16, 4),
        (16, 5),
        (17, 4),
        (17, 5),
        (18, 4),
        (18, 5);

insert into visitors (count)
values  (0);

-- create views

CREATE VIEW view_suppengericht AS
SELECT * FROM gericht
WHERE gericht.name LIKE '%suppe%';

CREATE VIEW view_anmeldungen AS
SELECT email, anzahlanmeldungen FROM benutzer
ORDER BY anzahlanmeldungen DESC;

CREATE VIEW view_kategorie_vegetarisch AS
SELECT gericht.name as Gericht, kategorie.name as Kategorie FROM gericht
                                                                     LEFT JOIN gericht_hat_kategorie ghk on gericht.id = ghk.gericht_id
                                                                     LEFT JOIN kategorie  on ghk.kategorie_id = kategorie.id
WHERE gericht.vegetarisch = 1
UNION
SELECT NULL, kategorie.name FROM kategorie;

-- create procedures

CREATE PROCEDURE inkrementiere_anzahlanmeldungen (
    IN input_id bigint)
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE benutzer.id = input_id;
END;

CREATE PROCEDURE valider_login (
    IN input_id bigint)
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE benutzer.id = input_id;
    UPDATE benutzer SET anzahlfehler = 0 WHERE benutzer.id= input_id;
    UPDATE benutzer SET letzteanmeldung = CURRENT_TIMESTAMP WHERE benutzer.id = input_id;
END;

CREATE PROCEDURE invalider_login (
    IN input_email varchar(100))
BEGIN
    UPDATE benutzer SET anzahlfehler = anzahlfehler + 1 WHERE benutzer.email=input_email;
    UPDATE benutzer SET letzterfehler = CURRENT_TIMESTAMP WHERE benutzer.email=input_email;
END;