CREATE TABLE tab_users (
  id int(20) NOT NULL,
  username varchar(70) NOT NULL,
  password varchar(40) NOT NULL,
  email varchar(50) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table tab_users
--

INSERT INTO tab_users (id, username, password, email, created_at, updated_at) VALUES
(1, 'julfou', 'monaco', 'julfou@esaip.org', '2017-11-22 00:00:00', '2017-11-23 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table tab_users
--
ALTER TABLE tab_users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY username (username);
  ADD UNIQUE KEY email (email);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table tab_users
--
ALTER TABLE tab_users
  MODIFY id int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;