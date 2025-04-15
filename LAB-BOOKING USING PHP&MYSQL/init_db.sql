CREATE DATABASE IF NOT EXISTS lab_booking;
USE lab_booking;

CREATE TABLE IF NOT EXISTS departments (
  dept_id VARCHAR(20) PRIMARY KEY,
  password VARCHAR(50),
  dept_name VARCHAR(100),
  hod VARCHAR(100)
);

INSERT INTO departments (dept_id, password, dept_name, hod) VALUES
('comp123', 'comp@123', 'Computer Science', 'Geetika Narang'),
('it123', 'it@123', 'Information Technology', 'Ravi Deshmukh'),
('entc123', 'entc@123', 'Electronics & Telecommunication', 'Neha Kulkarni'),
('mech123', 'mech@123', 'Mechanical', 'Suresh Patil'),
('civil123', 'civil@123', 'Civil', 'Meena Desai');

CREATE TABLE IF NOT EXISTS lab_status (
  id INT PRIMARY KEY DEFAULT 1,
  booked BOOLEAN DEFAULT 0,
  booked_by VARCHAR(100),
  free_time TIME
);

INSERT INTO lab_status (id, booked, booked_by, free_time) VALUES (1, 0, '', NULL)
ON DUPLICATE KEY UPDATE id=1;
