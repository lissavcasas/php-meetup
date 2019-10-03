--CONNECTION INFO

SCHEMA/USER: DEMO
PASSWORD: demo19
DATABASE NAME: 127.0.0.1:1521/xe
BD: ORACLE EXPRESS 11G

--Create table users

CREATE TABLE USERS
(
  USER_ID          INTEGER PRIMARY KEY,
  FIRST_NAME       VARCHAR2(255 BYTE),
  LAST_NAME        VARCHAR2(255 BYTE),
  USER_PHOTO       VARCHAR2(1000 BYTE),
  EMAIL            VARCHAR2(255 BYTE),
  USERNAME         VARCHAR2(255 BYTE),
  USER_POSITION    VARCHAR2(100 BYTE),
  USER_PHONE       NUMBER,
  USER_CELL_PHONE  NUMBER
)


--Crear sequencia
CREATE SEQUENCE USERS_SEQ
  START WITH 0
  MAXVALUE 9999999999999999999999999999
  MINVALUE 0
  NOCYCLE
  NOCACHE
  NOORDER;
  
 -- Agregar trigger
 
 CREATE OR REPLACE TRIGGER USERS_TRG
  BEFORE INSERT ON DEMO.USERS
  FOR EACH ROW
BEGIN
  SELECT USERS_SEQ.nextval
  INTO :new.user_id
  FROM dual;
END;

--OnGetCustomFormLayout

$layout -> setMode(FormLayoutMode:: VERTICAL);

$dataGroup = $layout -> addGroup('Información Personal', 12);

$dataGroup -> addRow()
  -> addCol($columns['USER_ID'], 4)
  -> addCol($columns['FIRST_NAME'], 4)
  -> addCol($columns['LAST_NAME'], 4);
  
  $dataGroup -> addRow()
  -> addCol($columns['USERNAME'], 6)
  -> addCol($columns['USER_POSITION'], 6);

  
$dataGroup = $layout -> addGroup('Datos de contacto', 12);

$dataGroup -> addRow()
  -> addCol($columns['EMAIL'], 4)
  -> addCol($columns['USER_PHONE'], 4)
  -> addCol($columns['USER_CELL_PHONE'], 4);

$dataGroup = $layout -> addGroup('Imágenes Adjuntas', 12);

$dataGroup -> addRow()
  -> addCol($columns['USER_PHOTO'], 6);