/*DROP DATABASE mams_db;*/
CREATE DATABASE MAMS_db;
USE MAMS_db;

/*DROP TABLE users;*/
CREATE TABLE users (
  id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  user_type varchar(20) NOT NULL DEFAULT 'user',
  image varchar(100) NOT NULL
);
ALTER TABLE users
  MODIFY id int(100) NOT NULL, AUTO_INCREMENT=31;

CREATE TABLE Machine (
    MachineID INT PRIMARY KEY,
    Model VARCHAR(255),
    Specifications TEXT,
    PurchaseDate DATE,
    WarrantyDetails TEXT
);
CREATE TABLE MachineHistory (
    MachineID INT PRIMARY KEY,
    ServiceHistory TEXT,
    MaintenanceSchedules TEXT,
    FOREIGN KEY (MachineID) REFERENCES Machine(MachineID) );
CREATE TABLE SparePart (
    PartNumber INT PRIMARY KEY,
    Description VARCHAR(255),
    QuantityAvailable INT,
    SupplierDetails TEXT,
    Price DECIMAL(10, 2),
    UsageHistory TEXT
);
CREATE TABLE Maintenance (
    MaintenanceID INT PRIMARY KEY,
    MachineID INT REFERENCES Machine(MachineID),
    MaintenanceType VARCHAR(255),
    MaintenanceDate DATE,
    Details TEXT
);
CREATE TABLE Repair (
    RepairID INT PRIMARY KEY,
    MachineID INT REFERENCES Machine(MachineID),
    IssueDescription TEXT,
    RepairDate DATE,
    Details TEXT
);
CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    ContactInformation TEXT,
    MachinesOwned TEXT,
    PurchaseHistory TEXT,
    WarrantyInformation TEXT,
    PasswordHash VARCHAR(255),
    Salt VARCHAR(50)
);
CREATE TABLE RequestStatus (
    StatusID INT PRIMARY KEY,
    StatusName VARCHAR(50) -- Add more attributes as needed
);
CREATE TABLE ServiceRequest (
    ServiceRequestID INT PRIMARY KEY,
    CustomerID INT REFERENCES Customer(CustomerID),
    MachineID INT REFERENCES Machine(MachineID),
    RequestDescription TEXT,
    RequestDate DATE,
    StatusID INT REFERENCES RequestStatus(StatusID),
    TechnicianAssigned INT REFERENCES ServiceProvider(ServiceProviderID)
);


   CREATE TABLE Technician (
    TechnicianID INT PRIMARY KEY,
    Username VARCHAR(100) UNIQUE,
    PasswordHash VARCHAR(255),  -- Store the hashed password
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    PhoneNumber VARCHAR(20),
    HireDate DATE
);


CREATE TABLE MaintenanceTask (
    TaskID INT PRIMARY KEY,
    MachineID INT,
    TechnicianID INT,
    Description TEXT,
    TaskDate DATE,
    Status VARCHAR(50),
    FOREIGN KEY (MachineID) REFERENCES Machine(MachineID),
    FOREIGN KEY (TechnicianID) REFERENCES Technician(TechnicianID)
);


CREATE TABLE StatusChangeLog (
    LogID INT PRIMARY KEY,
    MachineID INT,
    OldStatus VARCHAR(50),
    NewStatus VARCHAR(50),
    ChangeDateTime DATETIME,
    FOREIGN KEY (MachineID) REFERENCES Machine(MachineID)
);


CREATE TABLE OwnershipTransferHistory (
    TransferID INT PRIMARY KEY,
    MachineID INT,
    PreviousOwnerID INT,
    NewOwnerID INT,
    TransferDate DATE,
    CONSTRAINT FK_MachineID FOREIGN KEY (MachineID) REFERENCES Machine(MachineID),
    CONSTRAINT FK_PreviousOwner FOREIGN KEY (PreviousOwnerID) REFERENCES Customer(CustomerID),
    CONSTRAINT FK_NewOwner FOREIGN KEY (NewOwnerID) REFERENCES Customer(CustomerID)
);
