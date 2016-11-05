create table accountInfo
(
	accountInfoID int not null,
    accountPassword varchar(255) not null,
    accountType int not null,
    primary key(accountInfoID)
) ENGINE = InnoDB;
-------------------------------------------------------
create table bus
(
	busID int auto_increment not null,
    busModel varchar(25) null,
    busModelYear date null,
    busCapacity int not null,
    busIdleTime date not null,
    primary key(busID)
) ENGINE = InnoDB;; 


alter table bus auto_increment = 200001;
-------------------------------------------------------
create table line
(
	lineID int not null auto_increment,
    lineName varchar(25) not null,
    lineDesc varchar(50) null,
    primary key(lineID)
) ENGINE = InnoDB;

alter table line auto_increment = 1000001;
-------------------------------------------------------
create table updateBusLocation
(
	busID int not null,
    busLong double(50, 30) not null,
    busLati double(50, 30) not null,
    primary key(busID),
    foreign key(busID) references bus(busID) ON UPDATE CASCADE
) ENGINE = InnoDB;
--------------------------------------------------------
create table student
(
	studentID int auto_increment not null,
    accountType int not null,
    studentFN varchar(25) null,
    studentLN varchar(25) null,
    studentGender varchar(1) null,
    studentDoB date null,
    studentGrade varchar(2) null,
    studentBus int null,
    primary key(studentID),
    foreign key(studentBus) references bus(busID) ON UPDATE CASCADE
)ENGINE = InnoDB;

alter table student auto_increment = 201600001;
-------------------------------------------------------
create table parent
(
	parentID int auto_increment not null,
    accountType int not null,
    parentFN varchar(25) null,
    parentLN varchar(25) null,
    parentDoB date null,
    parentGender varchar(1) null,
    parentNumber varchar(25) not null,
    parentAddress varchar(50) null,
    primary key(parentID)
)ENGINE = InnoDB;

alter table parent auto_increment = 201610001;
---------------------------------------------------------
create table studentParent
(
	parentID int not null,
    studentID int not null,
    primary key(parentID, studentID),
    foreign key(parentID) references parent(parentID),
    foreign key(studentID) references student(studentID)
)ENGINE = InnoDB;
---------------------------------------------------------
create table driver
(
    driverID int auto_increment not null,
    accountType int not null,
    driverFN varchar(25) null,
    driverLN varchar(25) null,
    driverGender varchar(1) null,
    driverDoB date null,
    driverNumber varchar(25) not null,
    driverBusID int null,
    driverAddress varchar(50) null,
    driverlineID int null,
    primary key(driverID),
    foreign key(driverBusID) references bus(busID) ON UPDATE CASCADE ON DELETE SET NULL,
    foreign key(driverlineID) references line(lineID) ON UPDATE CASCADE ON DELETE SET NULL
)ENGINE = InnoDB;

alter table driver auto_increment = 300001;
---------------------------------------------------------
create table hotspot
(
	hotspotID int auto_increment not null,
    lineID int null,
    longitude decimal(10, 6) null,
    latitude decimal(10, 6) null,
    primary key(hotspotID),
    foreign key(lineID) references line(lineID) ON UPDATE CASCADE ON DELETE SET NULL
)ENGINE = InnoDB;

alter table hotspot auto_increment = 3000001;
--------------------------------------------------------
create table busRound
(
	roundID int auto_increment not null,
    busID int null,
    lineID int null,
    startTime date null,
    finishTime date null,
    primary key(roundID),
    foreign key(busID) references bus(busID) ON UPDATE CASCADE ON DELETE SET NULL,
    foreign key(lineID) references line(lineID) ON UPDATE CASCADE ON DELETE SET NULL
)ENGINE = InnoDB;

alter table busRound auto_increment = 2000001;
--------------------------------------------------------

