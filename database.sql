alter table users drop poin;
ALTER TABLE lembur ADD feedback varchar(255) default null;
ALTER TABLE lembur ADD reason varchar(255) default null;
ALTER TABLE lembur ADD rating float default 0;
ALTER TABLE lembur ADD achievement float default 0;
ALTER TABLE lembur ADD poin float default 0;
ALTER TABLE users ADD poin float default 0;
ALTER TABLE users ADD full_name varchar(100) default null;
UPDATE status_task SET label='Approved' WHERE id=6;