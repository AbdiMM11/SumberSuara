-- Tabel Roles
CREATE TABLE roles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_roles VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tabel Users
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    foto_user VARCHAR(255) NULL,
    password VARCHAR(255) NOT NULL,
    roles_id BIGINT NOT NULL,
    permissions JSON NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_users_roles FOREIGN KEY (roles_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- Tabel Audiens
CREATE TABLE audiens (
    id_audiens BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    umur INT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_audiens_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel Musisi
CREATE TABLE musisis (
    id_musisi BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    no_telp VARCHAR(20) NULL,
    domisili VARCHAR(255) NULL,
    genre VARCHAR(100) NULL,
    spotify VARCHAR(255) NULL,
    instagram VARCHAR(255) NULL,
    youtube VARCHAR(255) NULL,
    file_mp3 VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_musisis_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
