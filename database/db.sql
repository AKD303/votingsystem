-- Create the votingsystem database and tables
-- Use utf8mb4 and InnoDB for foreign key support.

DROP DATABASE IF EXISTS votingsystem;
CREATE DATABASE votingsystem CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE votingsystem;

-- Admins table
CREATE TABLE admins (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Students table
CREATE TABLE students (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  student_number VARCHAR(50) NOT NULL UNIQUE,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  course VARCHAR(100) DEFAULT NULL,
  year SMALLINT UNSIGNED DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Positions table (e.g., President, Secretary)
CREATE TABLE positions (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Candidates table. Candidates are optionally linked to a student account (student_id).
-- A student can be candidate for many positions, but a (student_id, position_id) pair is unique.
CREATE TABLE candidates (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  student_id INT UNSIGNED DEFAULT NULL,
  position_id INT UNSIGNED NOT NULL,
  name VARCHAR(100) NOT NULL,
  manifesto TEXT DEFAULT NULL,
  photo VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_candidates_student FOREIGN KEY (student_id)
    REFERENCES students(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT fk_candidates_position FOREIGN KEY (position_id)
    REFERENCES positions(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  UNIQUE KEY ux_candidate_student_position (student_id, position_id),
  INDEX idx_candidates_position (position_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Votes table. Each vote links a student to a candidate for a specific position.
-- UNIQUE (student_id, position_id) prevents a student voting more than once per position.
CREATE TABLE votes (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  student_id INT UNSIGNED NOT NULL,
  candidate_id INT UNSIGNED NOT NULL,
  position_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_votes_student FOREIGN KEY (student_id)
    REFERENCES students(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_votes_candidate FOREIGN KEY (candidate_id)
    REFERENCES candidates(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_votes_position FOREIGN KEY (position_id)
    REFERENCES positions(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  UNIQUE KEY ux_vote_one_per_position (student_id, position_id),
  INDEX idx_votes_candidate (candidate_id),
  INDEX idx_votes_position (position_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Optional: create a view to easily count votes per candidate (used later in result module)
CREATE OR REPLACE VIEW candidate_vote_counts AS
SELECT c.id AS candidate_id, c.name AS candidate_name, c.position_id, COUNT(v.id) AS votes
FROM candidates c
LEFT JOIN votes v ON c.id = v.candidate_id
GROUP BY c.id, c.name, c.position_id;
