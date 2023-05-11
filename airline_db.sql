CREATE TABLE pilots (
    id INT(11) auto_increment NOT NULL,
    firstname VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL,
    chief TINYINT(1) NOT NULL,
    birthdate DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255),
    street_number INT(11) NOT NULL,
    street_name VARCHAR(45) NOT NULL,
    zip_code INT(11) NOT NULL,
    city VARCHAR(45) NOT NULL,
    flight_hours INT(11) NOT NULL,
    PRIMARY KEY (id)

);

CREATE TABLE exams (
    id INT(11) auto_increment NOT NULL,
    name VARCHAR(255) NOT NULL,
    exam_date DATE NOT NULL,
    validity INT(11) NOT NULL,
    expiry_date DATE NOT NULL,
    next_exam_date DATE NOT NULL,
    exam_center VARCHAR(255),
    PRIMARY KEY (id)
)

CREATE TABLE medicalexamination(
    id INT(11) auto_increment NOT NULL,
    name VARCHAR(255) NOT NULL,
    examination_date DATE NOT NULL,
    validity INT(11) NOT NULL,
    expiry_date DATE NOT NULL,
    next_examination_date DATE NOT NULL,
    examination_hospital VARCHAR(255),
    PRIMARY KEY (id)
)
CREATE TABLE flights (
    id INT(11) auto_increment NOT NULL,
    departure_hour TIME NOT NULL,
    arrival_hour TIME  NOT NULL,
    departure_airport VARCHAR(45)  NOT NULL,
    arrival_airport VARCHAR(45)  NOT NULL,
    departure_city VARCHAR(45)  NOT NULL,
    arrival_city VARCHAR(45)  NOT NULL,
    id_plane INT(11) NOT NULL,   
    PRIMARY KEY (id),  
    FOREIGN KEY (id_plane) REFERENCES planes(id)
)

CREATE TABLE planes (
    id VARCHAR(11) auto_increment NOT NULL,
    name VARCHAR(45) NOT NULL,
    status TINYINT(1),
    last_maintenance DATE,
    capacity INT(11),
    PRIMARY KEY (id)
) 
CREATE TABLE articles(
    id int(11) auto_increment NOT NULL,
    name varchar(45),
    description text(),
    date current_timestamp(),
    PRIMARY KEY (id)

)
CREATE TABLE flight_pilot(
    id_flight int(11) NOT NULL,
    id_pilot int(11) NOT NULL,
    PRIMARY KEY(id_flight, id_pilot),
    FOREIGN KEY (id_flight) REFERENCES flights(id),
    FOREIGN KEY (id_pilot) REFERENCES pilots(id)
)
CREATE TABLE exams_pilot(
    id_exam int(11) NOT NULL,
    id_pilot int(11) NOT NULL,
    PRIMARY KEY(id_exam, id_pilot),
    FOREIGN KEY (id_exam) REFERENCES exams(id),
    FOREIGN KEY (id_pilot) REFERENCES pilots(id)
)
CREATE TABLE plane_pilot(
    id_plane int(11) NOT NULL,
    id_pilot int(11) NOT NULL,
    PRIMARY KEY(id_plane, id_pilot),
    FOREIGN KEY (id_plane) REFERENCES planes(id),
    FOREIGN KEY (id_pilot) REFERENCES pilots(id)
)

