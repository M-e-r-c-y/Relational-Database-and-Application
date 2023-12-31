CREATE TABLE Maintenance (
    MaintenanceID INT PRIMARY KEY,
    MachineID INT REFERENCES Machine(MachineID),
    MaintenanceType VARCHAR(255),
    MaintenanceDate DATE,
    Details TEXT
);


CREATE TABLE ServiceProvider (
    ServiceProviderID INT PRIMARY KEY,
    ServiceProviderName VARCHAR(255),
    ContactInformation TEXT

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

CREATE TABLE Technician (
    TechnicianID INT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    PhoneNumber VARCHAR(20),
    HireDate DATE
);


CREATE TABLE ServiceRequest (
    ServiceRequestID INT PRIMARY KEY,
    CustomerID INT REFERENCES Customer(CustomerID),
    MachineID INT REFERENCES Machine(MachineID),
    RequestDescription TEXT,
    RequestDate DATE,
    Status VARCHAR(50),
    TechnicianAssigned INT REFERENCES ServiceProvider(ServiceProviderID)
);

CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    ContactInformation TEXT,
    MachinesOwned TEXT,
    PurchaseHistory TEXT,
    WarrantyInformation TEXT,
);

CREATE TABLE Maintenance (
    MaintenanceID INT PRIMARY KEY,
    MachineID INT REFERENCES Machine(MachineID),
    MaintenanceType VARCHAR(255),
    MaintenanceDate DATE,
    Details TEXT
);
