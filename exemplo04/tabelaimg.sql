
-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";

--
-- Base de Dados: `banco`
--
create database banco;
use banco;
-- --------------------------------------------------------

--
-- Estrutura da tabela `tabelaimg`
--

CREATE TABLE IF NOT EXISTS tabelaimg (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  codigo int NOT NULL,
  produto varchar(80) NOT NULL,
  descricao varchar(250) NOT NULL,
  data datetime NOT NULL,
  valor float NOT NULL,
  imagem varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

--
-- Extraindo dados da tabela `tabelaimg`
--

INSERT INTO `tabelaimg` (`id`, `codigo`, `produto`, `descricao`, `data`, `valor`, `imagem`) VALUES
(1, 102030, 'Geladeira', 'Geladeira eletrolux, 3 portas, cinza, com tela oled, é tudo que você precisa com 5 niveis de resfriamento, compartimento de gelo e...', '2025', '6799.00', 'geladeira.png'),
(2, 112233, 'Cafeteira', 'Cafeteira britania, Proporciona mais praticidade e eficiência com capacidade para até 15 cafezinhos e filtro permanente removível para limpeza. Possui sistema corta-pingo que permite a retirada da jarra enquanto o café...', '2023', '318.00', 'cafeteira.png'),
(3, 302010, 'Fogão Cooktop', 'Quer mais praticidade na cozinha? Cooktop 4 Bocas Electrolux Indução e Gás Natural - IE60H é perfeito para o dia a dia em casas pequenas...', '2024', '3192.00', 'fogao.jpg'),
(4, 332211, 'Yooka-Laylee - PS4', '''Yooka-Laylee é uma nova plataforma de mundo aberto do principal criador por trás dos Banjo-Kazooie e Donkey Kong Country. Renovada na Playtonic Games, a equipe está construindo um sucessor espiritual para seu trabalho mais estimado do passado ...', '2017-05-01', '169.90', 'YookaLaylee.png'),
(5, 123456, 'The Last Guardian - PS4', 'The Last Guardian – PS4 é um dos games mais aguardados do momento. Ele possui uma narrativa de flashback, com um homem maduro contando histórias de quando era jovem, justamente na época em que encontra uma criatura conhecida como ''Trico'', que ...', '2017-05-01', '149.00', '');

