-- Categories Table
CREATE TABLE categories (
  category_id INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(255),
  PRIMARY KEY (category_id)
);

-- Movies Table
CREATE TABLE movies (
  movie_id INT(11) NOT NULL AUTO_INCREMENT,
  movie_name VARCHAR(255),
  release_date DATE,
  studio VARCHAR(255),
  category_id INT(11),
  PRIMARY KEY (movie_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Cinemas Table
CREATE TABLE cinemas (
  cinema_id INT(11) NOT NULL AUTO_INCREMENT,
  cinema_name VARCHAR(255),
  location VARCHAR(255),
  operator VARCHAR(255),
  PRIMARY KEY (cinema_id)
);

-- Showings Table
CREATE TABLE showings (
  showing_id INT(11) NOT NULL AUTO_INCREMENT,
  movie_id INT(11),
  cinema_id INT(11),
  showing_date DATE,
  showing_time TIME,
  PRIMARY KEY (showing_id),
  FOREIGN KEY (cinema_id) REFERENCES cinemas(cinema_id),
  FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
);

-- Users Table
CREATE TABLE users (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  phone_number VARCHAR(255),
  is_admin BOOLEAN DEFAULT 0,
  PRIMARY KEY (user_id)
);

-- Tickets Table
CREATE TABLE tickets (
  ticket_id INT(11) NOT NULL AUTO_INCREMENT,
  showing_id INT(11),
  user_id INT(11),
  seat_id CHAR(2),
  PRIMARY KEY (ticket_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (showing_id) REFERENCES showings(showing_id)
);

-- Default values for Categories
INSERT INTO categories (category_name)
VALUES
  ('Family'),
  ('Action & Adventure'),
  ('Horror'),
  ('Comedy'),
  ('Animation'),
  ('Drama'),
  ('Fantasy'),
  ('Sci-Fi');

-- Default values for Movies
INSERT INTO movies (movie_name, release_date, studio, category_id)
VALUES
  ('The Lego Movie', '2014-02-06', 'Warner Bros', 1),
  ('Your Name', '2016-12-08', 'CoMix Wave', 6),
  ('A Silent Voice', '2017-04-20', 'Kyoto Animation', 6),
  ('Alice in Wonderland', '2019-10-04', 'Walt Disney Pictures', 2),
  ('Little Witch Academia', '2013-03-02', 'Studio TRIGGER', 7),
  ('Sword Art Online: Ordinal Scale', '2017-02-18', 'A-1 Pictures', 2),
  ('Weathering With You', '2019-07-19', 'CoMix Wave', 6),
  ('Promare', '2019-05-24', 'Studio TRIGGER', 8),
  ('Non Non Biyori', '2018-08-25', 'Silver Link', 4),
  ('Blame! Movie', '2017-05-20', 'Polygon Pictures', 3);

-- Default values for Cinemas
INSERT INTO cinemas (cinema_name, location, operator)
VALUES
  ('KSL City', 'Johor Bahru', 'MBO Cinemas'),
  ('Suria KLCC', 'Kuala Lumpur City Centre', 'TGV Cinemas'),
  ('Harbour Mall', 'Sandakan', 'Lotus Five Star'),
  ('Suria Sabah', 'Kota Kinabalu', 'Golden Screen Cinemas'),
  ('Imago Mall', 'Kota Kinabalu', 'MBO Cinemas');

-- Default values for Showings
INSERT INTO showings (movie_id, cinema_id, showing_date, showing_time)
VALUES
  (8, 1, '2020-05-02', '09:00:00'),
  (1, 1, '2020-05-02', '12:00:00'),
  (5, 1, '2020-05-02', '21:00:00'),
  (9, 2, '2020-05-02', '09:00:00'),
  (7, 2, '2020-05-02', '12:00:00'),
  (1, 2, '2020-05-02', '21:00:00'),
  (4, 3, '2020-05-02', '09:00:00'),
  (3, 3, '2020-05-02', '12:00:00'),
  (10, 3, '2020-05-02', '21:00:00'),
  (7, 4, '2020-05-02', '09:00:00'),
  (4, 4, '2020-05-02', '12:00:00'),
  (9, 4, '2020-05-02', '21:00:00'),
  (6, 5, '2020-05-02', '09:00:00'),
  (5, 5, '2020-05-02', '12:00:00'),
  (2, 5, '2020-05-02', '21:00:00');

-- Default values for Users
INSERT INTO users (first_name, last_name, email, password, phone_number, is_admin)
VALUES 
  ('Marjorie', 'Phillips', 'marjorie@example.com', 'test1234', '01137920', 0),
  ('Ted', 'Mitchelle', 'ted@example.com', 'bbbb', '015794136', 0),
  ('Ronald', 'Dean', 'ronald@example.com', 'johnny1', '019610599', 0),
  ('Daisy', 'Romero', 'daisy@example.com', 'jackpot', '0110878763', 0),
  ('Marcia', 'Meyer', 'marcia@example.com', 'kingpin', '014327992', 0),
  ('Nellie', 'Daniels', 'nellie@example.com', 'weed', '016499849', 0),
  ('Steven', 'Bradley', 'steven@example.com', 'blackhaw', '012705717', 0),
  ('Joel', 'Mcdonalid', 'joel@example.com', 'bob123', '014569253', 0),
  ('Jesse', 'Hakala', 'jesse@example.com', 'peeper', '01105925', 0),
  ('Jeremy', 'Thompson', 'jeremy@example.com', 'virginie', '014440611', 0),
  ('Yannick', 'Kees', 'yannick@example.com', 'chance', '0110985913', 0),
  ('Imogen', 'Anderson', 'imogen@example.com', 'womble', '012259308', 0),
  ('Hanna', 'Ward', 'hanna@example.com', 'hassan', '011882041', 0),
  ('Flora', 'Dumas', 'flora@example.com', 'active', '0172438441', 0),
  ('Eeli', 'Saarinen', 'eeli@example.com', 'prosper', '01438531', 0);

-- Default values for Tickets
INSERT INTO tickets (showing_id, user_id, seat_id)
VALUES
  (1, 1, 'A9'),
  (2, 2, 'A5'),
  (3, 3, 'B2'),
  (4, 4, 'E3'),
  (5, 5, 'H7'),
  (6, 6, 'F1'),
  (7, 7, 'C8'),
  (8, 8, 'D4'),
  (9, 9, 'G6'),
  (10, 10, 'B5'),
  (11, 11, 'E4'),
  (12, 12, 'F7'),
  (13, 13, 'C4'),
  (14, 14, 'H9'),
  (15, 15, 'F5');