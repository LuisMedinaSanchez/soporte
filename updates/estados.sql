/*Actualizar estados de tickets*/
insert into status (id,name)
values (50,"En Desarrollo"),(75,"Solicitados para cierre"),(100,"Terminado"),(101,"Cancelado");
UPDATE ticket set status_id = 50 where status_id = 2;
UPDATE ticket set status_id = 100 where status_id = 3;
UPDATE ticket set status_id = 101 where status_id = 4;
DELETE FROM status WHERE status.id = 2;
DELETE FROM status WHERE status.id = 3;
DELETE FROM status WHERE status.id = 4;