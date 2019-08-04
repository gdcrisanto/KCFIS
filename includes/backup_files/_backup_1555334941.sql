

CREATE TABLE `acctinfotab` (
  `acctinfoID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) NOT NULL,
  `acctno` int(11) NOT NULL,
  `paymentPlan` enum('Installment','Full Payment') NOT NULL,
  `dateUpdated` date NOT NULL,
  `semester` enum('1st','2nd','','') NOT NULL,
  `schoolYear` tinytext NOT NULL,
  PRIMARY KEY (`acctinfoID`),
  KEY `studID` (`studID`),
  CONSTRAINT `acctinfotab_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `studentinfotab` (`studID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO acctinfotab VALUES("1","8","336544","Installment","2019-03-05","1st","");
INSERT INTO acctinfotab VALUES("2","8","878497","Full Payment","2019-03-06","2nd","");
INSERT INTO acctinfotab VALUES("3","8","835567","Full Payment","2019-03-31","1st","");
INSERT INTO acctinfotab VALUES("6","8","276027","Installment","2019-04-04","2nd","");
INSERT INTO acctinfotab VALUES("7","8","641245","Installment","2019-04-06","1st","");
INSERT INTO acctinfotab VALUES("8","8","246249","Full Payment","2019-04-08","2nd","");
INSERT INTO acctinfotab VALUES("9","11","176877","Full Payment","2019-04-12","2nd","");
INSERT INTO acctinfotab VALUES("10","8","471040","Installment","2019-04-13","1st","");
INSERT INTO acctinfotab VALUES("11","8","435592","Full Payment","2019-04-13","2nd","");
INSERT INTO acctinfotab VALUES("12","11","282765","Full Payment","2019-04-13","2nd","");



CREATE TABLE `expensetab` (
  `expenseID` int(11) NOT NULL AUTO_INCREMENT,
  `expenseType` enum('Communication','Fuel and Oil','Light and Water','Office Supplies','Rentals','Taxes and Licenses','Representations','Professional Fees','Salaries and Allowances','Transportation Allowances','Miscellaneous Expenses') NOT NULL,
  `remarks` longtext NOT NULL,
  `datePurchased` date NOT NULL,
  `amount` int(30) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`expenseID`),
  KEY `userID` (`userID`),
  CONSTRAINT `expensetab_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usertab` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO expensetab VALUES("1","Fuel and Oil","n/a","2019-03-11","15000","32");
INSERT INTO expensetab VALUES("2","Taxes and Licenses","n/a","2019-03-11","30000","32");
INSERT INTO expensetab VALUES("3","Office Supplies","n/a","2019-03-11","12000","32");
INSERT INTO expensetab VALUES("4","Representations","n/a","2019-04-03","13000","29");
INSERT INTO expensetab VALUES("5","Office Supplies","n/a","2019-04-03","2300","29");



CREATE TABLE `facsalarystatementtab` (
  `facsalarystatementID` int(11) NOT NULL AUTO_INCREMENT,
  `grossIncome` int(11) NOT NULL,
  `netIncome` int(11) NOT NULL,
  `withholdingTax` int(11) NOT NULL,
  `hourlyRate` int(11) NOT NULL,
  `hoursWorked` int(11) NOT NULL,
  `dateIssued` date NOT NULL,
  `facID` int(11) NOT NULL,
  PRIMARY KEY (`facsalarystatementID`),
  UNIQUE KEY `facID` (`facID`),
  CONSTRAINT `facsalarystatementtab_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `facultyinfotab` (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO facsalarystatementtab VALUES("1","73500","66150","7350","735","100","2019-04-15","1");
INSERT INTO facsalarystatementtab VALUES("8","62500","56250","6250","625","100","2019-04-15","2");



CREATE TABLE `facultyinfotab` (
  `facID` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `contactno` text NOT NULL,
  `employeeID` text NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO facultyinfotab VALUES("1","test","Professor","mname","09710924719","12414","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("2","test2","Professor2","mname","094471625418","123456","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("3","test3","Professor3","mname","09697465175","654321","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("4","Villena","Meg Therese","Fillarca","09178296763","10-2412","Esteban Abada");



CREATE TABLE `facultyratetab` (
  `facrateID` int(11) NOT NULL AUTO_INCREMENT,
  `facID` int(11) NOT NULL,
  `hourlyRate` int(30) NOT NULL,
  `dateUpdated` date NOT NULL,
  PRIMARY KEY (`facrateID`),
  KEY `facID` (`facID`),
  CONSTRAINT `facultyratetab_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `facultyinfotab` (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO facultyratetab VALUES("1","1","600","2016-11-15");
INSERT INTO facultyratetab VALUES("2","1","700","2019-03-04");
INSERT INTO facultyratetab VALUES("3","2","450","2018-04-16");
INSERT INTO facultyratetab VALUES("4","3","500","2017-08-08");
INSERT INTO facultyratetab VALUES("5","2","625","2019-03-04");
INSERT INTO facultyratetab VALUES("6","3","735","2019-03-04");
INSERT INTO facultyratetab VALUES("7","1","735","2019-04-06");



CREATE TABLE `fullpaymenttab` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `balance` int(30) NOT NULL,
  `amountReceived` int(30) NOT NULL,
  `modeOfPayment` enum('Cash','Credit','Debit','Check') NOT NULL,
  `dateReceived` date NOT NULL,
  `receiptNo` text NOT NULL,
  `acctinfoID` int(11) NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `acctinfoID` (`acctinfoID`),
  CONSTRAINT `fullpaymenttab_ibfk_1` FOREIGN KEY (`acctinfoID`) REFERENCES `acctinfotab` (`acctinfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO fullpaymenttab VALUES("1","50000","0","Cash","2019-04-08","","8");
INSERT INTO fullpaymenttab VALUES("2","0","50000","Cash","2019-04-09","580729","8");
INSERT INTO fullpaymenttab VALUES("3","30000","0","Cash","2019-03-12","","3");
INSERT INTO fullpaymenttab VALUES("4","40000","0","Cash","2019-01-04","","2");
INSERT INTO fullpaymenttab VALUES("5","0","40000","Cash","2019-04-09","293853","2");
INSERT INTO fullpaymenttab VALUES("6","0","30000","Cash","2019-04-09","685653","3");
INSERT INTO fullpaymenttab VALUES("7","50000","0","Cash","2019-04-12","","9");
INSERT INTO fullpaymenttab VALUES("8","40000","0","Cash","2019-04-13","","11");
INSERT INTO fullpaymenttab VALUES("9","50000","0","Cash","2019-04-13","","12");



CREATE TABLE `installmenttab` (
  `installmentID` int(11) NOT NULL AUTO_INCREMENT,
  `remainingBalance` int(30) NOT NULL,
  `amountReceived` int(30) NOT NULL,
  `modeOfPayment` enum('Cash','Credit','Debit','Check') NOT NULL,
  `dateReceived` date NOT NULL,
  `receiptNo` text NOT NULL,
  `acctinfoID` int(11) NOT NULL,
  PRIMARY KEY (`installmentID`),
  KEY `acctinfoID` (`acctinfoID`),
  CONSTRAINT `installmenttab_ibfk_1` FOREIGN KEY (`acctinfoID`) REFERENCES `acctinfotab` (`acctinfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO installmenttab VALUES("1","40000","10000","Cash","2019-01-10","","1");
INSERT INTO installmenttab VALUES("2","30000","10000","Cash","2019-02-06","111111","1");
INSERT INTO installmenttab VALUES("3","40000","0","Cash","2019-04-04","","6");
INSERT INTO installmenttab VALUES("8","30000","10000","Cash","2019-04-05","222222","6");
INSERT INTO installmenttab VALUES("10","25000","5000","Cash","2019-04-05","333333","6");
INSERT INTO installmenttab VALUES("11","40000","0","Cash","2019-04-06","","7");
INSERT INTO installmenttab VALUES("12","30000","10000","Cash","2019-04-06","123214","7");
INSERT INTO installmenttab VALUES("13","20000","0","Cash","2019-04-13","","10");
INSERT INTO installmenttab VALUES("14","19000","1000","Credit","2019-04-13","222222","10");



CREATE TABLE `otherincometab` (
  `otherIncomeID` int(11) NOT NULL AUTO_INCREMENT,
  `dateReceived` date NOT NULL,
  `receivedFrom` text NOT NULL,
  `amount` int(20) NOT NULL,
  `ackReceiptNo` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`otherIncomeID`),
  KEY `userID` (`userID`),
  CONSTRAINT `otherincometab_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usertab` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO otherincometab VALUES("1","2019-02-05","Cloverleaf","11000","111111","29");
INSERT INTO otherincometab VALUES("2","2019-02-19","Donations","100000","222222","29");
INSERT INTO otherincometab VALUES("3","2019-04-03","Cafeteria","13000","111111","29");
INSERT INTO otherincometab VALUES("4","2019-04-11","Mike","15000","12345","29");



CREATE TABLE `staffinfotab` (
  `staffID` int(11) NOT NULL AUTO_INCREMENT,
  `lname` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `contactno` text NOT NULL,
  `employeeID` text NOT NULL,
  `address` longtext NOT NULL,
  `position` text NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO staffinfotab VALUES("2","test","Technician","mname","0971092471","5362","#42 Mangga Rd.","techinician");
INSERT INTO staffinfotab VALUES("3","test2","Librarian","mname","09180941798","123456","#42 Mangga Rd.","librarian");
INSERT INTO staffinfotab VALUES("4","test3","Nurse","mname","0938167251","654321","#42 Mangga Rd.","nurse");



CREATE TABLE `staffsalarystatementtab` (
  `staffsalarystateID` int(11) NOT NULL AUTO_INCREMENT,
  `grossIncome` int(11) NOT NULL,
  `deductions` int(11) NOT NULL,
  `sss` int(11) NOT NULL,
  `pagibig` int(11) NOT NULL,
  `philhealth` int(11) NOT NULL,
  `withholdingTax` int(11) NOT NULL,
  `netIncome` int(11) NOT NULL,
  `staffID` int(11) NOT NULL,
  `dateIssued` date NOT NULL,
  PRIMARY KEY (`staffsalarystateID`),
  KEY `staffID` (`staffID`),
  CONSTRAINT `staffsalarystatementtab_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staffinfotab` (`staffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `staffsalarytab` (
  `staffsalaryID` int(11) NOT NULL AUTO_INCREMENT,
  `staffID` int(11) NOT NULL,
  `monthlySalary` int(11) NOT NULL,
  `dateUpdated` date NOT NULL,
  PRIMARY KEY (`staffsalaryID`),
  KEY `staffID` (`staffID`),
  CONSTRAINT `staffsalarytab_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staffinfotab` (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO staffsalarytab VALUES("1","2","15000","2016-04-06");
INSERT INTO staffsalarytab VALUES("2","2","16000","2017-08-19");
INSERT INTO staffsalarytab VALUES("3","2","18000","2018-07-09");
INSERT INTO staffsalarytab VALUES("7","2","19000","2019-03-04");
INSERT INTO staffsalarytab VALUES("8","3","15000","2019-03-04");
INSERT INTO staffsalarytab VALUES("9","4","20000","2019-03-04");



CREATE TABLE `studentinfotab` (
  `studID` int(11) NOT NULL AUTO_INCREMENT,
  `studentno` text NOT NULL,
  `lname` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `contactno` text NOT NULL,
  `address` longtext NOT NULL,
  PRIMARY KEY (`studID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO studentinfotab VALUES("8","15-0059","Crisanto","Diego","Campilan","09710924719","#48 Baker");
INSERT INTO studentinfotab VALUES("9","99-9999","test","Student","mname","09097051957","#42 Mangga Rd.");
INSERT INTO studentinfotab VALUES("10","88-8888","test2","Student2","mname","091270974109","#42 Mangga Rd.");
INSERT INTO studentinfotab VALUES("11","15-1371","del Castillo","John Michael","Guevarra","09175171591","#1 Clarion, Brookside Hills, Cainta, Rizal");



CREATE TABLE `systembackuptab` (
  `backupID` int(11) NOT NULL AUTO_INCREMENT,
  `dateSaved` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`backupID`),
  UNIQUE KEY `userID` (`userID`),
  CONSTRAINT `systembackuptab_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usertab` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `userinfotab` (
  `userinfoID` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `contactno` text NOT NULL,
  `address` longtext NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(40) NOT NULL,
  `citizenship` varchar(30) NOT NULL,
  `picture` blob NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`userinfoID`),
  KEY `userID` (`userID`),
  CONSTRAINT `userinfotab_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usertab` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO userinfotab VALUES("8","test","Cashier","mname","09179810249","#42 Mangga Rd.","Male","0198-12-09","Quezon City","Filipino","","29");
INSERT INTO userinfotab VALUES("9","test","Encoder","m","321321","","Male","0000-00-00","","","","30");
INSERT INTO userinfotab VALUES("10","test","Supervisor","m","123123","","Male","0000-00-00","","","","31");
INSERT INTO userinfotab VALUES("11","test","Finance","m","123123","","Male","0000-00-00","","","","32");
INSERT INTO userinfotab VALUES("12","test","System","m","123123","","Male","0000-00-00","","","","33");
INSERT INTO userinfotab VALUES("13","del Castillo","Mike","Guevarra","09175171591","","Male","0000-00-00","","","","34");



CREATE TABLE `usertab` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` longtext NOT NULL,
  `usertype` enum('Cashier','Data Encoder','Accounting Supervisor','Finance Admin','System Admin') NOT NULL,
  `userstatus` enum('Enabled','Disabled') NOT NULL DEFAULT 'Enabled',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO usertab VALUES("29","testCashier","$2y$10$bipw00HTxom3Wcxvjzyr1eFnBvc63Ghc/XmlndWIAXjKiv9MLeFKG","Cashier","Enabled");
INSERT INTO usertab VALUES("30","testEncoder","$2y$10$yahkjwUUVj5sLDBELNhqaO3YbBhDGD7FOKyy/dC6xd7G/ihnHKgvC","Data Encoder","Enabled");
INSERT INTO usertab VALUES("31","testAcctSup","$2y$10$WyajDvfRSWspV69wvmAbhe6xIciedWREgeJruHFQiRKjOsxRNFKP2","Accounting Supervisor","Enabled");
INSERT INTO usertab VALUES("32","testFinAd","$2y$10$/Aphp7qW5YkOg6KvSLb0GuGsV7oqM8gMOVPXo62XgQdRBY1/RKi6C","Finance Admin","Enabled");
INSERT INTO usertab VALUES("33","testSysAd","$2y$10$cSZwZiQpRusWc3I/hfQLau6X3dsGr.iHm8gzj9wrdnB1SaPv.EKl.","System Admin","Enabled");
INSERT INTO usertab VALUES("34","mikedelcastillo","$2y$10$sbXIL0MyumPKnmHwWSZ8oOaAdVFehS3KDaASnSGAvSQhnDcI0qicG","Accounting Supervisor","Enabled");

