CREATE TABLE IF NOT EXISTS User
(
    U_ID VARCHAR(8),
    Name VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Date_of_birth VARCHAR(50) NOT NULL,
    Country VARCHAR(50) NOT NULL,
    Game_ID VARCHAR(50) NOT NULL,
    PRIMARY KEY (U_ID)
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Backpack
(
	B_ID VARCHAR(8) ,
	U_ID VARCHAR(8) , 
	info VARCHAR(50) NULL ,
	PRIMARY KEY (B_ID,U_ID),
    FOREIGN KEY (U_ID) REFERENCES User(U_ID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Region
(
    R_ID VARCHAR(3),
    Name VARCHAR(50),
    PRIMARY KEY (R_ID)
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Pokemon
(
    P_ID VARCHAR(4),
    Name VARCHAR(50),
    info VARCHAR(50),
    Type VARCHAR(50),
    R_ID VARCHAR(3),
    HP VARCHAR(3),
    ATK VARCHAR(3),
    DEF VARCHAR(3),
    PRIMARY KEY (P_ID),
    FOREIGN KEY (R_ID) REFERENCES Region(R_ID) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Skill
(
    S_ID VARCHAR(3),
    Name VARCHAR(50) NOT NULL,
    Type VARCHAR(50) NOT NULL,
    damage VARCHAR(3),
    PRIMARY KEY (S_ID)
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Pokemon_type
(
    P_ID VARCHAR(4),
    type VARCHAR(50),
    PRIMARY KEY (P_ID,type),
    FOREIGN KEY (P_ID) REFERENCES Pokemon (P_ID) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Evolve
(
    Evo_P_ID VARCHAR(4),
    Ori_P_ID VARCHAR(4),
    PRIMARY KEY (Evo_P_ID),
    FOREIGN KEY (Evo_P_ID) REFERENCES Pokemon (P_ID)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Ori_P_ID) REFERENCES Pokemon (P_ID)  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Have
(
    B_ID VARCHAR(8),
    P_ID VARCHAR(4),
    PRIMARY KEY (B_ID,P_ID),
    FOREIGN KEY (B_ID) REFERENCES Backpack (B_ID)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (P_ID) REFERENCES Pokemon (P_ID)  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS Learn
(
    P_ID VARCHAR(4),
    S_ID VARCHAR(3),
    PRIMARY KEY (P_ID,S_ID),
    FOREIGN KEY (P_ID) REFERENCES Pokemon (P_ID)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (S_ID) REFERENCES Skill (S_ID)  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO Region (R_ID,Name) values('1','Kanto'),
('2','Johto'),
('3','Hoenn'),
('4','Sinnoh'),
('5','Unova'),
('6','Kalos');