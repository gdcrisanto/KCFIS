

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO acctinfotab VALUES("13","9","733200","Installment","2019-04-16","1st","");
INSERT INTO acctinfotab VALUES("14","9","668955","Full Payment","2019-04-16","1st","");
INSERT INTO acctinfotab VALUES("15","8","871870","Full Payment","2019-04-16","2nd","");
INSERT INTO acctinfotab VALUES("16","8","954310","Full Payment","2019-04-16","2nd","");
INSERT INTO acctinfotab VALUES("17","8","723495","Installment","2019-04-16","1st","");
INSERT INTO acctinfotab VALUES("18","8","477875","Installment","2019-04-18","2nd","");
INSERT INTO acctinfotab VALUES("19","8","850857","Installment","2019-04-18","1st","");
INSERT INTO acctinfotab VALUES("20","8","683684","Installment","2019-04-18","1st","");
INSERT INTO acctinfotab VALUES("21","9","871503","Installment","2019-04-18","2nd","");



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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO expensetab VALUES("1","Fuel and Oil","n/a","2019-03-11","15000","32");
INSERT INTO expensetab VALUES("2","Taxes and Licenses","n/a","2019-03-11","30000","32");
INSERT INTO expensetab VALUES("3","Office Supplies","n/a","2019-03-11","12000","32");
INSERT INTO expensetab VALUES("4","Representations","n/a","2019-04-03","13000","29");
INSERT INTO expensetab VALUES("5","Office Supplies","n/a","2019-04-03","2300","29");
INSERT INTO expensetab VALUES("6","Salaries and Allowances","thank you","2019-04-18","689","31");
INSERT INTO expensetab VALUES("7","Fuel and Oil","for sex","2019-04-18","400","31");
INSERT INTO expensetab VALUES("8","Miscellaneous Expenses","asfdafaasf","2019-04-24","0","31");
INSERT INTO expensetab VALUES("9","Office Supplies","xzbvzbzbz","2019-04-24","-65853","31");



CREATE TABLE `facsalarystatementtab` (
  `facsalarystatementID` int(11) NOT NULL AUTO_INCREMENT,
  `grossIncome` float NOT NULL,
  `netIncome` float NOT NULL,
  `withholdingTax` float NOT NULL,
  `hourlyRate` float NOT NULL,
  `hoursWorked` float NOT NULL,
  `dateIssued` date NOT NULL,
  `facID` int(11) NOT NULL,
  PRIMARY KEY (`facsalarystatementID`),
  KEY `facID_2` (`facID`),
  CONSTRAINT `facsalarystatementtab_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `facultyinfotab` (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO facsalarystatementtab VALUES("1","73500","66150","7350","735","100","2019-04-15","1");
INSERT INTO facsalarystatementtab VALUES("8","62500","56250","6250","625","100","2019-04-15","2");
INSERT INTO facsalarystatementtab VALUES("17","75985","68386.5","7598.5","835","91","2019-04-16","4");
INSERT INTO facsalarystatementtab VALUES("21","100","90","10","1","100","2019-04-19","5");
INSERT INTO facsalarystatementtab VALUES("23","76875","69187.5","7687.5","625","123","2019-04-19","7");
INSERT INTO facsalarystatementtab VALUES("26","90405","81364.5","9040.5","735","123","2019-04-19","1");
INSERT INTO facsalarystatementtab VALUES("27","1338120","1204310","133812","625","2141","2019-04-24","2");



CREATE TABLE `facultyinfotab` (
  `facID` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `contactno` text NOT NULL,
  `employeeID` text NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO facultyinfotab VALUES("1","test","Professor","mname","09710924719","12414","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("2","test2","Professor2","mname","094471625418","123456","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("3","test3","Professor3","mname","09697465175","654321","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("4","Villena","Meg Therese","Fillarca","09178296763","10-2412","Esteban Abada");
INSERT INTO facultyinfotab VALUES("5","Santos","Alyssa","K","09173109640","654321","Pasig");
INSERT INTO facultyinfotab VALUES("6","santos","Diego","m","09710924719","654321","1231312r41fasfsagwagawg");
INSERT INTO facultyinfotab VALUES("7","vinoya","danica","isabelle","99999999","5362","#42 Mangga Rd.");
INSERT INTO facultyinfotab VALUES("8","A name","askihgdakjsdasd","Middles","091468686868","699","1004 100th brgy. caniogan po");



CREATE TABLE `facultyratetab` (
  `facrateID` int(11) NOT NULL AUTO_INCREMENT,
  `facID` int(11) NOT NULL,
  `hourlyRate` int(30) NOT NULL,
  `dateUpdated` date NOT NULL,
  PRIMARY KEY (`facrateID`),
  KEY `facID` (`facID`),
  CONSTRAINT `facultyratetab_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `facultyinfotab` (`facID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO facultyratetab VALUES("1","1","600","2016-11-15");
INSERT INTO facultyratetab VALUES("2","1","700","2019-03-04");
INSERT INTO facultyratetab VALUES("3","2","450","2018-04-16");
INSERT INTO facultyratetab VALUES("4","3","500","2017-08-08");
INSERT INTO facultyratetab VALUES("5","2","625","2019-03-04");
INSERT INTO facultyratetab VALUES("6","3","735","2019-03-04");
INSERT INTO facultyratetab VALUES("7","1","735","2019-04-06");
INSERT INTO facultyratetab VALUES("8","4","835","2019-04-16");
INSERT INTO facultyratetab VALUES("9","5","100000000","2019-04-18");
INSERT INTO facultyratetab VALUES("10","5","10000","2019-04-18");
INSERT INTO facultyratetab VALUES("11","5","1","2019-04-18");
INSERT INTO facultyratetab VALUES("12","7","625","2019-04-18");
INSERT INTO facultyratetab VALUES("13","3","68","2019-04-18");
INSERT INTO facultyratetab VALUES("14","3","766","2019-04-18");



CREATE TABLE `incomestatementtab` (
  `incomestatementID` int(11) NOT NULL AUTO_INCREMENT,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL,
  `dateCreated` date NOT NULL,
  `totalExpense` float NOT NULL,
  `totalRevenue` float NOT NULL,
  `totalIncome` float NOT NULL,
  PRIMARY KEY (`incomestatementID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO incomestatementtab VALUES("4","2018-02-13","2019-04-17","2019-04-17","296051","261913","-34138");
INSERT INTO incomestatementtab VALUES("5","2018-10-09","2019-04-17","2019-04-17","296051","211913","-84138");
INSERT INTO incomestatementtab VALUES("6","1997-07-20","2019-04-18","2019-04-18","316958","384671","67713");



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO otherincometab VALUES("1","2019-02-05","Cloverleaf","11000","111111","29");
INSERT INTO otherincometab VALUES("2","2019-02-19","Donations","100000","222222","29");
INSERT INTO otherincometab VALUES("3","2019-04-03","Cafeteria","13000","111111","29");
INSERT INTO otherincometab VALUES("4","2019-04-11","Mike","15000","12345","29");
INSERT INTO otherincometab VALUES("5","2019-04-18","Mike","13000","222222","29");
INSERT INTO otherincometab VALUES("6","2019-04-18","sander","69","9","29");
INSERT INTO otherincometab VALUES("7","2019-04-18","My ass","2147483647","103942","29");
INSERT INTO otherincometab VALUES("8","2019-04-24","sagdgsda","-12314","680520","29");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO staffinfotab VALUES("2","test","Technician","mname","0971092471","5362","#42 Mangga Rd.","techinician");
INSERT INTO staffinfotab VALUES("3","test2","Librarian","mname","09180941798","123456","#42 Mangga Rd.","librarian");
INSERT INTO staffinfotab VALUES("4","test3","Nurse","mname","0938167251","654321","#42 Mangga Rd.","nurse");
INSERT INTO staffinfotab VALUES("5","test","askihgdakjsdasd","37264dsvas","09710924719","12414","#48 Baker","librarian");
INSERT INTO staffinfotab VALUES("6","uy","sandro","j","0971092471","12414","#42 Mangga Rd.","TAGA");
INSERT INTO staffinfotab VALUES("7","Crisanto","Diego","C.","-","1203345","-","Professor ");



CREATE TABLE `staffsalarystatementtab` (
  `staffsalarystateID` int(11) NOT NULL AUTO_INCREMENT,
  `grossIncome` float NOT NULL,
  `adjustmentsDeduc` float NOT NULL,
  `sss` float NOT NULL,
  `pagibig` float NOT NULL,
  `philhealth` float NOT NULL,
  `withholdingTax` float NOT NULL,
  `netIncome` float NOT NULL,
  `staffID` int(11) NOT NULL,
  `dateIssued` date NOT NULL,
  `adjustmentsAdd` float NOT NULL,
  `undertime` float NOT NULL,
  `absences` float NOT NULL,
  `personalLoans` float NOT NULL,
  `paidLeaves` float NOT NULL,
  `overtimePays` float NOT NULL,
  `monthlySalary` int(11) NOT NULL,
  PRIMARY KEY (`staffsalarystateID`),
  KEY `staffID` (`staffID`),
  CONSTRAINT `staffsalarystatementtab_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staffinfotab` (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO staffsalarystatementtab VALUES("3","19003","1","1","1","1","1","18995","2","2019-04-16","1","1","1","1","1","1","19000");
INSERT INTO staffsalarystatementtab VALUES("4","15779.6","1","1234","3","31","1","13969.5","3","2019-04-16","532.7","13","213.1","314","123.4","123.5","15000");
INSERT INTO staffsalarystatementtab VALUES("5","20218","0","0","0","0","0","20218","4","2019-04-18","50","0","0","0","88","80","20000");



CREATE TABLE `staffsalarytab` (
  `staffsalaryID` int(11) NOT NULL AUTO_INCREMENT,
  `staffID` int(11) NOT NULL,
  `monthlySalary` int(11) NOT NULL,
  `dateUpdated` date NOT NULL,
  PRIMARY KEY (`staffsalaryID`),
  KEY `staffID` (`staffID`),
  CONSTRAINT `staffsalarytab_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staffinfotab` (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO staffsalarytab VALUES("1","2","15000","2016-04-06");
INSERT INTO staffsalarytab VALUES("2","2","16000","2017-08-19");
INSERT INTO staffsalarytab VALUES("3","2","18000","2018-07-09");
INSERT INTO staffsalarytab VALUES("7","2","19000","2019-03-04");
INSERT INTO staffsalarytab VALUES("8","3","15000","2019-03-04");
INSERT INTO staffsalarytab VALUES("9","4","20000","2019-03-04");
INSERT INTO staffsalarytab VALUES("10","5","9990","2019-04-18");
INSERT INTO staffsalarytab VALUES("11","5","8880","2019-04-18");
INSERT INTO staffsalarytab VALUES("12","6","90","2019-04-18");
INSERT INTO staffsalarytab VALUES("13","6","70","2019-04-18");
INSERT INTO staffsalarytab VALUES("14","2","20001","2019-04-24");
INSERT INTO staffsalarytab VALUES("15","2","20001","2019-04-24");



CREATE TABLE `studentinfotab` (
  `studID` int(11) NOT NULL AUTO_INCREMENT,
  `studentno` text NOT NULL,
  `lname` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `contactno` text NOT NULL,
  `address` longtext NOT NULL,
  PRIMARY KEY (`studID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO studentinfotab VALUES("8","15-0059","Crisanto","Gian","Campilan","09710924719","#48 Baker");
INSERT INTO studentinfotab VALUES("9","99-9999","test","Student","mname","09097051957","#42 Mangga Rd.");
INSERT INTO studentinfotab VALUES("10","88-8888","test2","Student2","mname","091270974109","#42 Mangga Rd.");
INSERT INTO studentinfotab VALUES("11","15-1371","del Castillo","John Michael","Guevarra","09175171591","#1 Clarion, Brookside Hills, Cainta, Rizal");
INSERT INTO studentinfotab VALUES("12","78-203140","hesukristo","si jesus","christ","0994321321","1004 100th brgy. caniogan po");



CREATE TABLE `studtranstab` (
  `studtransID` int(11) NOT NULL AUTO_INCREMENT,
  `acctinfoID` int(11) NOT NULL,
  `remainingBalance` float NOT NULL,
  `amountReceived` float NOT NULL,
  `modeOfPayment` enum('Cash','Credit','Debit','Check') NOT NULL,
  `receiptNo` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  PRIMARY KEY (`studtransID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO studtranstab VALUES("1","13","40000","0","Cash","0","2019-04-02");
INSERT INTO studtranstab VALUES("2","13","18659","21341","Cash","759770","2018-10-09");
INSERT INTO studtranstab VALUES("3","14","50000","0","Cash","0","2019-04-16");
INSERT INTO studtranstab VALUES("4","15","50000","0","Cash","0","2019-04-01");
INSERT INTO studtranstab VALUES("5","15","0","50000","Debit","681848","2018-02-13");
INSERT INTO studtranstab VALUES("6","16","35831","0","Cash","0","2019-04-16");
INSERT INTO studtranstab VALUES("7","17","51572","0","Cash","0","2019-04-16");
INSERT INTO studtranstab VALUES("8","17","43924","7648","Debit","898360","2019-02-12");
INSERT INTO studtranstab VALUES("9","17","0","43924","Cash","254813","2019-04-16");
INSERT INTO studtranstab VALUES("10","18","1","0","Cash","0","2019-04-18");
INSERT INTO studtranstab VALUES("11","19","1000000","0","Cash","0","2019-04-18");
INSERT INTO studtranstab VALUES("12","19","900001","99999","Cash","794351","2019-04-18");
INSERT INTO studtranstab VALUES("13","19","891001","9000","Credit","381477","2019-04-18");
INSERT INTO studtranstab VALUES("14","20","50000","0","Cash","0","2019-04-18");
INSERT INTO studtranstab VALUES("15","13","39310","690","Cash","748390","2019-04-18");
INSERT INTO studtranstab VALUES("16","21","50000","0","Cash","0","2019-04-18");
INSERT INTO studtranstab VALUES("17","19","46000","4000","Credit","633472","2019-04-24");
INSERT INTO studtranstab VALUES("18","21","48766","1234","Credit","535758","2019-04-24");



CREATE TABLE `systembackuptab` (
  `backupID` int(11) NOT NULL AUTO_INCREMENT,
  `dateSaved` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`backupID`),
  UNIQUE KEY `userID` (`userID`),
  CONSTRAINT `systembackuptab_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usertab` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO systembackuptab VALUES("1","2019-04-15 15:38:28","29");
INSERT INTO systembackuptab VALUES("2","2019-04-18 13:49:26","33");



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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO userinfotab VALUES("8","test","Cashier","mname","09179810249","#42 Mangga Rd. dfbxn","Male","1998-12-09","Quezon City","Filipino","","29");
INSERT INTO userinfotab VALUES("9","test","Encoder","m","321321","","Male","0000-00-00","","","","30");
INSERT INTO userinfotab VALUES("10","test","Supervisor","m","123123","","Male","0000-00-00","","","","31");
INSERT INTO userinfotab VALUES("11","test","Finance","m","123123","","Male","0000-00-00","","","","32");
INSERT INTO userinfotab VALUES("12","test","System","m","123123","","Male","0000-00-00","","","","33");
INSERT INTO userinfotab VALUES("13","del Castillo","Mike","Guevarra","09175171591","","Male","0000-00-00","","","","34");
INSERT INTO userinfotab VALUES("14","Capistrano","Alessandro","Raphael ","917333333","","Male","0000-00-00","","","","35");



CREATE TABLE `usertab` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` longtext NOT NULL,
  `usertype` enum('Cashier','Data Encoder','Accounting Supervisor','Finance Admin','System Admin') NOT NULL,
  `userstatus` enum('Enabled','Disabled') NOT NULL DEFAULT 'Enabled',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

INSERT INTO usertab VALUES("29","testCashier","$2y$10$bipw00HTxom3Wcxvjzyr1eFnBvc63Ghc/XmlndWIAXjKiv9MLeFKG","Cashier","Disabled");
INSERT INTO usertab VALUES("30","testEncoder","$2y$10$yahkjwUUVj5sLDBELNhqaO3YbBhDGD7FOKyy/dC6xd7G/ihnHKgvC","Data Encoder","Enabled");
INSERT INTO usertab VALUES("31","testAcctSup","$2y$10$WyajDvfRSWspV69wvmAbhe6xIciedWREgeJruHFQiRKjOsxRNFKP2","Accounting Supervisor","Enabled");
INSERT INTO usertab VALUES("32","testFinAd","$2y$10$/Aphp7qW5YkOg6KvSLb0GuGsV7oqM8gMOVPXo62XgQdRBY1/RKi6C","Finance Admin","Enabled");
INSERT INTO usertab VALUES("33","testSysAd","$2y$10$cSZwZiQpRusWc3I/hfQLau6X3dsGr.iHm8gzj9wrdnB1SaPv.EKl.","System Admin","Enabled");
INSERT INTO usertab VALUES("34","mikedelcastillo","$2y$10$sbXIL0MyumPKnmHwWSZ8oOaAdVFehS3KDaASnSGAvSQhnDcI0qicG","Accounting Supervisor","Disabled");
INSERT INTO usertab VALUES("35","alesraphcap","$2y$10$rEW5bythGq.XpX4RBhhFh.W6LHgPGrBX35XN6AtiQ8jVZEGYTaMrm","Cashier","Disabled");

