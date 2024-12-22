
CREATE TABLE dossier_medical (
    dossier_id SERIAL PRIMARY KEY,
    date_dossie TIMESTAMP NOT NULL,
    diagnostic TEXT,
    traitement TEXT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,               
    full_name VARCHAR(255) NOT NULL,      
    email VARCHAR(255) NOT NULL UNIQUE,  
    password VARCHAR(255) NOT NULL,      
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    role_id INT REFERENCES role(id),    
    status VARCHAR(50) NOT NULL CHECK (status IN ('actif', 'archivé')), 
    is_confirmed BOOLEAN DEFAULT FALSE  
);

CREATE TABLE rendez_vous (
    id SERIAL PRIMARY KEY,
    cni VARCHAR(20) NOT NULL,
    date_rendez_vous TIMESTAMP NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    is_confirmed BOOLEAN DEFAULT FALSE, 
    FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE
);


CREATE TYPE role_type AS ENUM ('user', 'admin', 'doctor');

CREATE TABLE role (
    id SERIAL PRIMARY KEY,
    name role_type NOT NULL
);


CREATE TABLE chambre (
    chambre_id SERIAL PRIMARY KEY,
    num INT NOT NULL,
    type VARCHAR(50),
    statut VARCHAR(50) CHECK (statut IN ('disponible', 'occupée')),
    dossier_id INT NOT NULL,
    FOREIGN KEY (dossier_id) REFERENCES dossier_medical(dossier_id) ON DELETE CASCADE
);



SELECT conname, pg_get_constraintdef(oid)
FROM pg_constraint
WHERE conrelid = 'chambre'::regclass;