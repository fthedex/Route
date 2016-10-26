create table accountInfo
(
	accountInfoID int not null,
    accountPassword varchar(255) not null,
    accountType int null,
    primary key(accountInfoID)
)

create table bus
(
	busID int auto_increment not null,
    busModel varchar(25) null,
    busModelYear date null,
    busCapacity int null,
    busIdleTime date null,
    primary key(busID)
)

create table line
(
	lineID int not null,
    lineName varchar(25) null,
    primary key(lineID)
);

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
);


create table hotspot
(
	hotspotID int auto_increment not null,
    lineID int null,
    longitude decimal(10, 6) null,
    latitude decimal(10, 6) null,
    primary key(hotspotID),
    foreign key(lineID) references line(lineID) ON UPDATE CASCADE ON DELETE SET NULL
);

create table busRoundTime
(
	roundID int not null,
    hotspotID int not null,
    EAT time null,
    primary key(roundID, hotspotID),
    foreign key(roundID) references busRound(roundID) ON UPDATE CASCADE,
    foreign key(hotspotID) references hotspot(hotspotID) ON UPDATE CASCADE
);

create table busRoundHistory
(
	roundID int not null,
    hotspotID int not null,
    roundDate date null,
    EAT time null,
    AAT time null,
    primary key(roundID, hotspotID)
);

create table driver
(
    driverID int auto_increment not null,
    accountType int null,
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
);


create table updateBusLocation
(
	busID int not null,
    busLong decimal(10,6) null,
    busLati decimal(10,6) null,
    primary key(busID),
    foreign key(busID) references bus(busID) ON UPDATE CASCADE
);

create table parent
(
	parentID int auto_increment not null,
    accountType int null,
    parentFN varchar(25) null,
    parentLN varchar(25) null,
    parentDoB date null,
    parentGender varchar(1) null,
    parentNumber varchar(25) null,
    parentAddress varchar(50) null,
    primary key(parentID)
);

create table student
(
	studentID int auto_increment not null,
    accountType int null,
    studentFN varchar(25) null,
    studentLN varchar(25) null,
    studentGender varchar(1) null,
    studentDoB date null,
    studentGrade varchar(2) null,
    studentRound int null,
    primary key(studentID),
    foreign key(studentRound) references busRound(roundID) ON UPDATE CASCADE
);


create table studentParent
(
	parentID int not null,
    studentID int not null,
    primary key(parentID, studentID),
    foreign key(parentID) references parent(parentID),
    foreign key(studentID) references student(studentID)
);

