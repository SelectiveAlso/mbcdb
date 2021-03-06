<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run()
    {
        if (env('PRODUCTION') === false) {
          $this->call(DevBadgesTableSeeder::class);
          $this->call(DevCouncilsTableSeeder::class);
          $this->call(DevDistrictsTableSeeder::class);
          $this->call(DevUsersTableSeeder::class);
          $this->call(DevCounselorsTableSeeder::class);
          $this->call(DevLukeSeeder::class);
        } else {
          $this->call(ProdBadgesTableSeeder::class);
          $this->call(ProdCouncilsTableSeeder::class);
          $this->call(ProdDistrictsTableSeeder::class);
        }
    }
}


class DevLukeSeeder extends Seeder {
  // Development Only Seeder
  public function run() {
    $user = new App\User;
    $user->id = strtolower(str_replace(['.', ',', '/'], "", substr(bcrypt(time()), 10, 8)));
    $user->name = "Luke Sweeney";
    $user->email = "luke@thesweeneys.org";
    $user->isAdmin = 1;
		$user->verified = 1;
    $user->password = bcrypt("password");
    $user->save();

		for ($i=0; $i < 10; $i++) {
			$counselor = factory('App\Counselor')->create();
			$district = App\District::all()->random(1);
			$district->counselors()->save($counselor);
			$user->counselors()->save($counselor);
		}

    $user = new App\User;
    $user->id = strtolower(str_replace(['.', ',', '/'], "", substr(bcrypt(time()), 10, 8)));
    $user->name = "Luke's Non Admin";
    $user->email = "lukesjunk@thesweeneys.org";
    $user->isAdmin = 0;
		$user->verified = 1;
    $user->password = bcrypt("password");
    $user->save();

		for ($i=0; $i < 10; $i++) {
			$counselor = factory('App\Counselor')->create();
			$district = App\District::all()->random(1);
			$district->counselors()->save($counselor);
			$user->counselors()->save($counselor);
		}
  }
}
class DevCouncilsTableSeeder extends Seeder {
  public function run() {
  		for ($y=0; $y < 15; $y++) {
  			$council = factory('App\Council')->create();
  		}
  }
}
class DevDistrictsTableSeeder extends Seeder {
  public function run() {
    for ($r=0; $r < 25; $r++) {
    	$district = factory('App\District')->create();
    	$council = App\Council::all()->random(1);
    	$council->districts()->save($district);
    }
  }
}
class DevCounselorsTableSeeder extends Seeder {
  // Devolopment Only Seeder
  public function run() {
    for ($c=0; $c < 50; $c++) {
      $counselor = factory('App\Counselor')->create();

      // Associate counselor with district
      $district = App\District::all()->random(1);
      $district->counselors()->save($counselor);

      // Associate counselor with user
      $user = App\User::all()->random(1);
      $user->counselors()->save($counselor);

      // Associate counselor with 7 badges
      $badges = App\Badge::all()->random(7);
      foreach($badges as $badge) {
        $counselor->badges()->save($badge);
      }

      // Associate counselor with council
      $council = App\Council::all()->random(1);
      $council->counselors()->save($counselor);
    }
  }
}
class DevUsersTableSeeder extends Seeder {
  // Development Only Seeder
  public function run() {
    for ($i=0; $i < 35; $i++) {
      $user = factory('App\User')->create();
    }
  }
}
class DevBadgesTableSeeder extends Seeder {
	public function run() {
		DB::select( DB::raw("INSERT INTO `badges` VALUES (1,1,'Camping','2016-05-07 02:39:41','2016-05-07 02:39:41'),(2,2,'Citizenship in the Community','2016-05-07 11:34:36','2016-05-07 11:34:36'),(3,3,'Citizenship in the Nation','2016-05-07 11:34:48','2016-05-07 11:34:48'),(4,4,'Citizenship in the World','2016-05-07 11:35:12','2016-05-07 11:35:12'),(5,5,'Communications','2016-05-07 11:35:23','2016-05-07 11:35:23'),(6,6,'Emergency Preparedness','2016-05-07 11:35:49','2016-05-07 11:35:49'),(7,7,'Environmental Science','2016-05-07 11:36:04','2016-05-07 11:36:04'),(8,8,'First Aid','2016-05-07 11:36:13','2016-05-07 11:36:13'),(9,9,'Lifesaving','2016-05-07 11:36:23','2016-05-07 11:36:23'),(10,10,'Personal Fitness','2016-05-07 11:36:34','2016-05-07 11:36:34'),(11,11,'Personal Management','2016-05-07 11:36:47','2016-05-07 11:36:47'),(12,12,'Safety','2016-05-07 11:36:57','2016-05-07 11:36:57'),(13,13,'Sports','2016-05-07 11:37:06','2016-05-07 11:37:06'),(14,14,'Swimming','2016-05-07 11:37:14','2016-05-07 11:37:14'),(15,15,'American Business','2016-05-07 11:37:25','2016-05-07 11:37:25'),(16,16,'American Heritage','2016-05-07 11:37:36','2016-05-07 11:37:36'),(17,17,'American Cultures','2016-05-07 11:39:23','2016-05-07 11:39:23'),(18,18,'Animal Science','2016-05-07 11:39:40','2016-05-07 11:39:40'),(19,19,'Archery','2016-05-07 11:39:46','2016-05-07 11:39:46'),(20,20,'Architecture','2016-05-07 11:40:37','2016-05-07 11:40:37'),(21,21,'Art','2016-05-07 11:40:44','2016-05-07 11:40:44'),(22,22,'Astronomy','2016-05-07 11:41:00','2016-05-07 11:41:00'),(23,23,'Athletics','2016-05-07 11:41:08','2016-05-07 11:41:08'),(24,24,'Nuclear Science','2016-05-07 11:41:23','2016-05-07 11:41:23'),(25,25,'Aviation','2016-05-07 11:41:32','2016-05-07 11:41:32'),(26,26,'Backpacking','2016-05-07 11:41:41','2016-05-07 11:41:41'),(27,27,'Basketry','2016-05-07 11:42:07','2016-05-07 11:42:07'),(28,28,'Beekeeping','2016-05-07 11:42:16','2016-05-07 11:42:16'),(29,29,'Bird Study','2016-05-07 11:42:26','2016-05-07 11:42:26'),(30,30,'Bookbinding','2016-05-07 11:42:38','2016-05-07 11:42:38'),(31,31,'Botany','2016-05-07 11:42:51','2016-05-07 11:42:51'),(32,32,'Bugling','2016-05-07 11:43:01','2016-05-07 11:43:01'),(33,33,'Canoeing','2016-05-07 11:43:12','2016-05-07 11:43:12'),(34,34,'Chemistry','2016-05-07 11:43:20','2016-05-07 11:43:20'),(35,35,'Coin Collecting','2016-05-07 11:43:28','2016-05-07 11:43:28'),(36,36,'Computers','2016-05-07 11:43:38','2016-05-07 11:43:38'),(37,37,'Consumer Buying','2016-05-07 11:43:49','2016-05-07 11:43:49'),(38,38,'Cooking','2016-05-07 11:44:00','2016-05-07 11:44:00'),(39,39,'Cycling','2016-05-07 11:44:19','2016-05-07 11:44:19'),(40,40,'Dentistry','2016-05-07 11:45:02','2016-05-07 11:45:02'),(41,41,'Dog Care','2016-05-07 11:45:10','2016-05-07 11:45:10'),(42,42,'Drafting','2016-05-07 11:45:19','2016-05-07 11:45:19'),(43,43,'Electricity','2016-05-07 11:45:30','2016-05-07 11:45:30'),(44,44,'Electronics','2016-05-07 11:45:40','2016-05-07 11:45:40'),(45,45,'Energy','2016-05-07 11:46:00','2016-05-07 11:46:00'),(46,46,'Engineering','2016-05-07 11:46:10','2016-05-07 11:46:10'),(47,47,'Farm and Ranch Management','2016-05-07 11:47:11','2016-05-07 11:47:11'),(48,48,'Farm Mechanics','2016-05-07 11:47:23','2016-05-07 11:47:23'),(49,49,'Fingerprinting','2016-05-07 11:47:35','2016-05-07 11:47:35'),(50,50,'Fire Safety','2016-05-07 11:47:44','2016-05-07 11:47:44'),(51,51,'Fish and Wildlife Management','2016-05-07 11:48:02','2016-05-07 11:48:02'),(52,52,'Fishing','2016-05-07 11:48:07','2016-05-07 11:48:07'),(53,53,'Food Systems','2016-05-07 11:49:13','2016-05-07 11:49:13'),(54,54,'Forestry','2016-05-07 11:49:23','2016-05-07 11:49:23'),(55,55,'Gardening','2016-05-07 11:49:31','2016-05-07 11:49:31'),(56,56,'Genealogy','2016-05-07 11:49:43','2016-05-07 11:49:43'),(57,57,'General Science','2016-05-07 11:49:52','2016-05-07 11:49:52'),(58,58,'Geology','2016-05-07 11:49:59','2016-05-07 11:49:59'),(59,59,'Golf','2016-05-07 11:50:06','2016-05-07 11:50:06'),(60,60,'Disabilities Awareness','2016-05-07 11:50:47','2016-05-07 11:50:47'),(61,61,'Hiking','2016-05-07 11:51:18','2016-05-07 11:51:18'),(62,62,'Home Repairs','2016-05-07 11:51:32','2016-05-07 11:51:32'),(63,63,'Horsemanship','2016-05-07 11:51:45','2016-05-07 11:51:45'),(64,64,'Indian Lore','2016-05-07 11:51:53','2016-05-07 11:51:53'),(65,65,'Insect Study','2016-05-07 11:52:03','2016-05-07 11:52:03'),(66,66,'Journalism','2016-05-07 11:52:17','2016-05-07 11:52:17'),(67,67,'Landscape Architecture','2016-05-07 11:52:29','2016-05-07 11:52:29'),(68,68,'Law','2016-05-07 11:52:42','2016-05-07 11:52:42'),(69,69,'Leatherwork','2016-05-07 11:52:50','2016-05-07 11:52:50'),(70,70,'Machinery','2016-05-07 11:52:58','2016-05-07 11:52:58'),(71,71,'Mammal Study','2016-05-07 11:53:07','2016-05-07 11:53:07'),(72,72,'Masonry','2016-05-07 11:53:19','2016-05-07 11:53:19'),(73,73,'Metals Engineering','2016-05-07 11:53:32','2016-05-07 11:53:32'),(74,74,'Metalwork','2016-05-07 11:53:49','2016-05-07 11:53:49'),(75,75,'Model Design and Building','2016-05-07 11:54:07','2016-05-07 11:54:07'),(76,76,'Motorboating','2016-05-07 11:54:19','2016-05-07 11:54:19'),(77,77,'Music','2016-05-07 11:54:26','2016-05-07 11:54:26'),(78,78,'Nature','2016-05-07 11:54:33','2016-05-07 11:54:33'),(79,79,'Oceanography','2016-05-07 11:54:44','2016-05-07 11:54:44'),(80,80,'Orienteering','2016-05-07 11:54:54','2016-05-07 11:54:54'),(81,81,'Painting','2016-05-07 11:55:00','2016-05-07 11:55:00'),(82,82,'Pets','2016-05-07 11:55:07','2016-05-07 11:55:07'),(83,83,'Photography','2016-05-07 11:55:19','2016-05-07 11:55:19'),(84,84,'Pioneering','2016-05-07 11:55:27','2016-05-07 11:55:27'),(85,85,'Plant Science','2016-05-07 11:55:37','2016-05-07 11:55:37'),(86,86,'Plumbing','2016-05-07 11:55:44','2016-05-07 11:55:44'),(87,87,'Pottery','2016-05-07 11:56:04','2016-05-07 11:56:04'),(88,88,'Printing','2016-05-07 11:56:15','2016-05-07 11:56:15'),(89,89,'Public Health','2016-05-07 11:56:24','2016-05-07 11:56:24'),(90,90,'Public Speaking','2016-05-07 11:56:33','2016-05-07 11:56:33'),(91,91,'Pulp and Paper','2016-05-07 11:56:42','2016-05-07 11:56:42'),(92,92,'Rabbit Raising','2016-05-07 11:57:11','2016-05-07 11:57:11'),(93,93,'Radio','2016-05-07 11:57:19','2016-05-07 11:57:19'),(94,94,'Railroading','2016-05-07 11:57:27','2016-05-07 11:57:27'),(95,95,'Reading','2016-05-07 11:57:36','2016-05-07 11:57:36'),(96,96,'Reptile and Amphibian Study','2016-05-07 11:58:35','2016-05-07 11:58:35'),(97,97,'Rifle and Shotgun Shooting','2016-05-07 11:58:54','2016-05-07 11:58:54'),(98,98,'Rowing','2016-05-07 11:59:01','2016-05-07 11:59:01'),(99,99,'Salesmanship','2016-05-07 11:59:15','2016-05-07 11:59:15'),(100,100,'Scholarship','2016-05-07 11:59:27','2016-05-07 11:59:27'),(101,101,'Scupture','2016-05-07 12:00:03','2016-05-07 12:00:03'),(102,102,'Signalling','2016-05-07 12:00:23','2016-05-07 12:00:23'),(103,103,'Skating','2016-05-07 12:00:33','2016-05-07 12:00:33'),(104,104,'Skiing','2016-05-07 12:00:42','2016-05-07 12:00:42'),(105,105,'Small-Boat Sailing','2016-05-07 12:00:58','2016-05-07 12:00:58'),(106,106,'Soil and Water Conservation','2016-05-07 12:01:13','2016-05-07 12:01:13'),(107,107,'Space Exploration','2016-05-07 12:01:21','2016-05-07 12:01:21'),(108,108,'Stamp Collecting','2016-05-07 12:01:30','2016-05-07 12:01:30'),(109,109,'Surveying','2016-05-07 12:01:44','2016-05-07 12:01:44'),(110,110,'Textile','2016-05-07 12:01:52','2016-05-07 12:01:52'),(111,111,'Theater','2016-05-07 12:02:03','2016-05-07 12:02:03'),(112,112,'Traffic Safety','2016-05-07 12:02:12','2016-05-07 12:02:12'),(113,113,'Truck Transportation','2016-05-07 12:02:22','2016-05-07 12:02:22'),(114,114,'Veterinary Medicine','2016-05-07 12:02:37','2016-05-07 12:02:37'),(115,115,'Water Sports','2016-05-07 12:02:47','2016-05-07 12:02:47'),(116,116,'Weather','2016-05-07 12:02:54','2016-05-07 12:02:54'),(117,117,'Wilderness Survival','2016-05-07 12:03:04','2016-05-07 12:03:04'),(118,118,'Wood Carving','2016-05-07 12:03:11','2016-05-07 12:03:11'),(119,119,'Woodwork','2016-05-07 12:03:18','2016-05-07 12:03:18'),(120,120,'Agribusiness','2016-05-07 12:03:32','2016-05-07 12:03:32'),(121,121,'American Labor','2016-05-07 12:03:42','2016-05-07 12:03:42'),(122,122,'Graphic Arts','2016-05-07 12:03:54','2016-05-07 12:03:54'),(123,123,'Rifle Shooting','2016-05-07 12:04:03','2016-05-07 12:04:03'),(124,124,'Shotgun Shooting','2016-05-07 12:04:13','2016-05-07 12:04:13'),(125,125,'Whitewater','2016-05-07 12:04:22','2016-05-07 12:04:22'),(126,126,'Cinematography','2016-05-07 12:04:33','2016-05-07 12:04:33'),(127,127,'Auto Mechanics','2016-05-07 12:05:07','2016-05-07 12:05:07'),(128,128,'Collections','2016-05-07 12:05:17','2016-05-07 12:05:17'),(129,129,'Family Life','2016-05-07 12:05:26','2016-05-07 12:05:26'),(130,130,'Medicine','2016-05-07 12:05:52','2016-05-07 12:05:52'),(131,131,'Crime Prevention','2016-05-07 12:06:08','2016-05-07 12:06:08'),(132,132,'Archaeology','2016-05-07 12:06:17','2016-05-07 12:07:22'),(133,133,'Climbing','2016-05-07 12:07:51','2016-05-07 12:07:51'),(134,134,'Entrepreneurship','2016-05-07 12:08:15','2016-05-07 12:08:15'),(135,135,'Snow Sports','2016-05-07 12:08:25','2016-05-07 12:08:25'),(136,136,'Fly Fishing','2016-05-07 12:08:35','2016-05-07 12:08:35'),(137,137,'Composite Materials','2016-05-07 12:09:22','2016-05-07 12:09:22'),(138,138,'Scuba Diving','2016-05-07 12:09:32','2016-05-07 12:09:32'),(139,139,'Carpentry (Centennial Merit Badge)','2016-05-07 12:10:15','2016-05-07 12:10:15'),(140,140,'Pathfinding (Centennial Merit Badge)','2016-05-07 12:10:33','2016-05-07 12:10:33'),(141,141,'Signaling (Centennial Merit Badge)','2016-05-07 12:11:04','2016-05-07 12:11:04'),(142,142,'Tracking (Centennial Merit Badge)','2016-05-07 12:11:21','2016-05-07 12:11:21'),(143,143,'Scouting Heritage','2016-05-07 12:11:31','2016-05-07 12:11:31'),(144,144,'Inventing','2016-05-07 12:11:53','2016-05-07 12:11:53'),(145,145,'Geocaching','2016-05-07 12:12:08','2016-05-07 12:12:08'),(146,146,'Robotics','2016-05-07 12:12:16','2016-05-07 12:12:16'),(147,147,'Chess','2016-05-07 12:12:33','2016-05-07 12:12:33'),(148,148,'Welding','2016-05-07 12:12:40','2016-05-07 12:12:40'),(149,149,'Kayaking','2016-05-07 12:12:47','2016-05-07 12:12:47'),(150,150,'Search and Rescue','2016-05-07 12:12:55','2016-05-07 12:12:55'),(151,151,'Game Design','2016-05-07 12:13:03','2016-05-07 12:13:03'),(152,152,'Sustainability','2016-05-07 12:13:14','2016-05-07 12:13:14'),(153,153,'Programming','2016-05-07 12:13:21','2016-05-07 12:13:21'),(154,154,'Digital Technology','2016-05-07 12:13:32','2016-05-07 12:13:32'),(155,155,'Mining in Society','2016-05-07 12:13:45','2016-05-07 12:13:45'),(156,156,'Moviemaking','2016-05-07 12:13:56','2016-05-07 12:13:56'),(157,157,'Animation','2016-05-07 12:14:02','2016-05-07 12:14:02'),(158,158,'Signs, Signals, and Codes','2016-05-07 12:14:18','2016-05-07 12:14:18'),(159,159,'Computer-Aided Design','2016-05-07 12:14:38','2016-05-07 12:14:38'),(160,160,'Advanced Computing','2016-05-07 12:14:46','2016-05-07 12:14:46');") );
	}
}

class ProdCouncilsTableSeeder extends Seeder {
	public function run() {
    $councils = [
      'Sam Houston Area'
    ];

    foreach ($councils as $councilName) {
      $council = new App\Council(['name' => $councilName]);
      $council->save();
    }
	}
}
class ProdDistrictsTableSeeder extends Seeder {
  public function run() {
    $districts = [
      'Aldine Pathfinder',
      'Antares',
      'Aquila',
      'Arrowmoon',
      'Big Cypress',
      'Brahman',
      'Brazos',
      'Copperhead',
      'David Crockett',
      'Flaming Arrow',
      'George Strake',
      'Iron Horse',
      'Mustang',
      'North Star',
      'Orion',
      'Phoenix',
      'Raven',
      'San Jacinto',
      'Skyline',
      'Soaring Eagle',
      'Tall Timbers',
      'Tatanka',
      'Texas Skies',
      'Thunder Wolf',
      'Twin Bayou',
      'W.L. Davis',
    ];
    // cause fuck naming conventions, that's why
    foreach ($districts as $districtName) {
      $district = new App\District(['name' => $districtName, 'council_id' => 1]);
      $district->save();
    }
	}
}
class ProdBadgesTableSeeder extends Seeder {
	public function run() {
		DB::select( DB::raw("INSERT INTO `badges` VALUES (1,1,'Camping','2016-05-07 02:39:41','2016-05-07 02:39:41'),(2,2,'Citizenship in the Community','2016-05-07 11:34:36','2016-05-07 11:34:36'),(3,3,'Citizenship in the Nation','2016-05-07 11:34:48','2016-05-07 11:34:48'),(4,4,'Citizenship in the World','2016-05-07 11:35:12','2016-05-07 11:35:12'),(5,5,'Communications','2016-05-07 11:35:23','2016-05-07 11:35:23'),(6,6,'Emergency Preparedness','2016-05-07 11:35:49','2016-05-07 11:35:49'),(7,7,'Environmental Science','2016-05-07 11:36:04','2016-05-07 11:36:04'),(8,8,'First Aid','2016-05-07 11:36:13','2016-05-07 11:36:13'),(9,9,'Lifesaving','2016-05-07 11:36:23','2016-05-07 11:36:23'),(10,10,'Personal Fitness','2016-05-07 11:36:34','2016-05-07 11:36:34'),(11,11,'Personal Management','2016-05-07 11:36:47','2016-05-07 11:36:47'),(12,12,'Safety','2016-05-07 11:36:57','2016-05-07 11:36:57'),(13,13,'Sports','2016-05-07 11:37:06','2016-05-07 11:37:06'),(14,14,'Swimming','2016-05-07 11:37:14','2016-05-07 11:37:14'),(15,15,'American Business','2016-05-07 11:37:25','2016-05-07 11:37:25'),(16,16,'American Heritage','2016-05-07 11:37:36','2016-05-07 11:37:36'),(17,17,'American Cultures','2016-05-07 11:39:23','2016-05-07 11:39:23'),(18,18,'Animal Science','2016-05-07 11:39:40','2016-05-07 11:39:40'),(19,19,'Archery','2016-05-07 11:39:46','2016-05-07 11:39:46'),(20,20,'Architecture','2016-05-07 11:40:37','2016-05-07 11:40:37'),(21,21,'Art','2016-05-07 11:40:44','2016-05-07 11:40:44'),(22,22,'Astronomy','2016-05-07 11:41:00','2016-05-07 11:41:00'),(23,23,'Athletics','2016-05-07 11:41:08','2016-05-07 11:41:08'),(24,24,'Nuclear Science','2016-05-07 11:41:23','2016-05-07 11:41:23'),(25,25,'Aviation','2016-05-07 11:41:32','2016-05-07 11:41:32'),(26,26,'Backpacking','2016-05-07 11:41:41','2016-05-07 11:41:41'),(27,27,'Basketry','2016-05-07 11:42:07','2016-05-07 11:42:07'),(28,28,'Beekeeping','2016-05-07 11:42:16','2016-05-07 11:42:16'),(29,29,'Bird Study','2016-05-07 11:42:26','2016-05-07 11:42:26'),(30,30,'Bookbinding','2016-05-07 11:42:38','2016-05-07 11:42:38'),(31,31,'Botany','2016-05-07 11:42:51','2016-05-07 11:42:51'),(32,32,'Bugling','2016-05-07 11:43:01','2016-05-07 11:43:01'),(33,33,'Canoeing','2016-05-07 11:43:12','2016-05-07 11:43:12'),(34,34,'Chemistry','2016-05-07 11:43:20','2016-05-07 11:43:20'),(35,35,'Coin Collecting','2016-05-07 11:43:28','2016-05-07 11:43:28'),(36,36,'Computers','2016-05-07 11:43:38','2016-05-07 11:43:38'),(37,37,'Consumer Buying','2016-05-07 11:43:49','2016-05-07 11:43:49'),(38,38,'Cooking','2016-05-07 11:44:00','2016-05-07 11:44:00'),(39,39,'Cycling','2016-05-07 11:44:19','2016-05-07 11:44:19'),(40,40,'Dentistry','2016-05-07 11:45:02','2016-05-07 11:45:02'),(41,41,'Dog Care','2016-05-07 11:45:10','2016-05-07 11:45:10'),(42,42,'Drafting','2016-05-07 11:45:19','2016-05-07 11:45:19'),(43,43,'Electricity','2016-05-07 11:45:30','2016-05-07 11:45:30'),(44,44,'Electronics','2016-05-07 11:45:40','2016-05-07 11:45:40'),(45,45,'Energy','2016-05-07 11:46:00','2016-05-07 11:46:00'),(46,46,'Engineering','2016-05-07 11:46:10','2016-05-07 11:46:10'),(47,47,'Farm and Ranch Management','2016-05-07 11:47:11','2016-05-07 11:47:11'),(48,48,'Farm Mechanics','2016-05-07 11:47:23','2016-05-07 11:47:23'),(49,49,'Fingerprinting','2016-05-07 11:47:35','2016-05-07 11:47:35'),(50,50,'Fire Safety','2016-05-07 11:47:44','2016-05-07 11:47:44'),(51,51,'Fish and Wildlife Management','2016-05-07 11:48:02','2016-05-07 11:48:02'),(52,52,'Fishing','2016-05-07 11:48:07','2016-05-07 11:48:07'),(53,53,'Food Systems','2016-05-07 11:49:13','2016-05-07 11:49:13'),(54,54,'Forestry','2016-05-07 11:49:23','2016-05-07 11:49:23'),(55,55,'Gardening','2016-05-07 11:49:31','2016-05-07 11:49:31'),(56,56,'Genealogy','2016-05-07 11:49:43','2016-05-07 11:49:43'),(57,57,'General Science','2016-05-07 11:49:52','2016-05-07 11:49:52'),(58,58,'Geology','2016-05-07 11:49:59','2016-05-07 11:49:59'),(59,59,'Golf','2016-05-07 11:50:06','2016-05-07 11:50:06'),(60,60,'Disabilities Awareness','2016-05-07 11:50:47','2016-05-07 11:50:47'),(61,61,'Hiking','2016-05-07 11:51:18','2016-05-07 11:51:18'),(62,62,'Home Repairs','2016-05-07 11:51:32','2016-05-07 11:51:32'),(63,63,'Horsemanship','2016-05-07 11:51:45','2016-05-07 11:51:45'),(64,64,'Indian Lore','2016-05-07 11:51:53','2016-05-07 11:51:53'),(65,65,'Insect Study','2016-05-07 11:52:03','2016-05-07 11:52:03'),(66,66,'Journalism','2016-05-07 11:52:17','2016-05-07 11:52:17'),(67,67,'Landscape Architecture','2016-05-07 11:52:29','2016-05-07 11:52:29'),(68,68,'Law','2016-05-07 11:52:42','2016-05-07 11:52:42'),(69,69,'Leatherwork','2016-05-07 11:52:50','2016-05-07 11:52:50'),(70,70,'Machinery','2016-05-07 11:52:58','2016-05-07 11:52:58'),(71,71,'Mammal Study','2016-05-07 11:53:07','2016-05-07 11:53:07'),(72,72,'Masonry','2016-05-07 11:53:19','2016-05-07 11:53:19'),(73,73,'Metals Engineering','2016-05-07 11:53:32','2016-05-07 11:53:32'),(74,74,'Metalwork','2016-05-07 11:53:49','2016-05-07 11:53:49'),(75,75,'Model Design and Building','2016-05-07 11:54:07','2016-05-07 11:54:07'),(76,76,'Motorboating','2016-05-07 11:54:19','2016-05-07 11:54:19'),(77,77,'Music','2016-05-07 11:54:26','2016-05-07 11:54:26'),(78,78,'Nature','2016-05-07 11:54:33','2016-05-07 11:54:33'),(79,79,'Oceanography','2016-05-07 11:54:44','2016-05-07 11:54:44'),(80,80,'Orienteering','2016-05-07 11:54:54','2016-05-07 11:54:54'),(81,81,'Painting','2016-05-07 11:55:00','2016-05-07 11:55:00'),(82,82,'Pets','2016-05-07 11:55:07','2016-05-07 11:55:07'),(83,83,'Photography','2016-05-07 11:55:19','2016-05-07 11:55:19'),(84,84,'Pioneering','2016-05-07 11:55:27','2016-05-07 11:55:27'),(85,85,'Plant Science','2016-05-07 11:55:37','2016-05-07 11:55:37'),(86,86,'Plumbing','2016-05-07 11:55:44','2016-05-07 11:55:44'),(87,87,'Pottery','2016-05-07 11:56:04','2016-05-07 11:56:04'),(88,88,'Printing','2016-05-07 11:56:15','2016-05-07 11:56:15'),(89,89,'Public Health','2016-05-07 11:56:24','2016-05-07 11:56:24'),(90,90,'Public Speaking','2016-05-07 11:56:33','2016-05-07 11:56:33'),(91,91,'Pulp and Paper','2016-05-07 11:56:42','2016-05-07 11:56:42'),(92,92,'Rabbit Raising','2016-05-07 11:57:11','2016-05-07 11:57:11'),(93,93,'Radio','2016-05-07 11:57:19','2016-05-07 11:57:19'),(94,94,'Railroading','2016-05-07 11:57:27','2016-05-07 11:57:27'),(95,95,'Reading','2016-05-07 11:57:36','2016-05-07 11:57:36'),(96,96,'Reptile and Amphibian Study','2016-05-07 11:58:35','2016-05-07 11:58:35'),(97,97,'Rifle and Shotgun Shooting','2016-05-07 11:58:54','2016-05-07 11:58:54'),(98,98,'Rowing','2016-05-07 11:59:01','2016-05-07 11:59:01'),(99,99,'Salesmanship','2016-05-07 11:59:15','2016-05-07 11:59:15'),(100,100,'Scholarship','2016-05-07 11:59:27','2016-05-07 11:59:27'),(101,101,'Scupture','2016-05-07 12:00:03','2016-05-07 12:00:03'),(102,102,'Signalling','2016-05-07 12:00:23','2016-05-07 12:00:23'),(103,103,'Skating','2016-05-07 12:00:33','2016-05-07 12:00:33'),(104,104,'Skiing','2016-05-07 12:00:42','2016-05-07 12:00:42'),(105,105,'Small-Boat Sailing','2016-05-07 12:00:58','2016-05-07 12:00:58'),(106,106,'Soil and Water Conservation','2016-05-07 12:01:13','2016-05-07 12:01:13'),(107,107,'Space Exploration','2016-05-07 12:01:21','2016-05-07 12:01:21'),(108,108,'Stamp Collecting','2016-05-07 12:01:30','2016-05-07 12:01:30'),(109,109,'Surveying','2016-05-07 12:01:44','2016-05-07 12:01:44'),(110,110,'Textile','2016-05-07 12:01:52','2016-05-07 12:01:52'),(111,111,'Theater','2016-05-07 12:02:03','2016-05-07 12:02:03'),(112,112,'Traffic Safety','2016-05-07 12:02:12','2016-05-07 12:02:12'),(113,113,'Truck Transportation','2016-05-07 12:02:22','2016-05-07 12:02:22'),(114,114,'Veterinary Medicine','2016-05-07 12:02:37','2016-05-07 12:02:37'),(115,115,'Water Sports','2016-05-07 12:02:47','2016-05-07 12:02:47'),(116,116,'Weather','2016-05-07 12:02:54','2016-05-07 12:02:54'),(117,117,'Wilderness Survival','2016-05-07 12:03:04','2016-05-07 12:03:04'),(118,118,'Wood Carving','2016-05-07 12:03:11','2016-05-07 12:03:11'),(119,119,'Woodwork','2016-05-07 12:03:18','2016-05-07 12:03:18'),(120,120,'Agribusiness','2016-05-07 12:03:32','2016-05-07 12:03:32'),(121,121,'American Labor','2016-05-07 12:03:42','2016-05-07 12:03:42'),(122,122,'Graphic Arts','2016-05-07 12:03:54','2016-05-07 12:03:54'),(123,123,'Rifle Shooting','2016-05-07 12:04:03','2016-05-07 12:04:03'),(124,124,'Shotgun Shooting','2016-05-07 12:04:13','2016-05-07 12:04:13'),(125,125,'Whitewater','2016-05-07 12:04:22','2016-05-07 12:04:22'),(126,126,'Cinematography','2016-05-07 12:04:33','2016-05-07 12:04:33'),(127,127,'Auto Mechanics','2016-05-07 12:05:07','2016-05-07 12:05:07'),(128,128,'Collections','2016-05-07 12:05:17','2016-05-07 12:05:17'),(129,129,'Family Life','2016-05-07 12:05:26','2016-05-07 12:05:26'),(130,130,'Medicine','2016-05-07 12:05:52','2016-05-07 12:05:52'),(131,131,'Crime Prevention','2016-05-07 12:06:08','2016-05-07 12:06:08'),(132,132,'Archaeology','2016-05-07 12:06:17','2016-05-07 12:07:22'),(133,133,'Climbing','2016-05-07 12:07:51','2016-05-07 12:07:51'),(134,134,'Entrepreneurship','2016-05-07 12:08:15','2016-05-07 12:08:15'),(135,135,'Snow Sports','2016-05-07 12:08:25','2016-05-07 12:08:25'),(136,136,'Fly Fishing','2016-05-07 12:08:35','2016-05-07 12:08:35'),(137,137,'Composite Materials','2016-05-07 12:09:22','2016-05-07 12:09:22'),(138,138,'Scuba Diving','2016-05-07 12:09:32','2016-05-07 12:09:32'),(139,139,'Carpentry (Centennial Merit Badge)','2016-05-07 12:10:15','2016-05-07 12:10:15'),(140,140,'Pathfinding (Centennial Merit Badge)','2016-05-07 12:10:33','2016-05-07 12:10:33'),(141,141,'Signaling (Centennial Merit Badge)','2016-05-07 12:11:04','2016-05-07 12:11:04'),(142,142,'Tracking (Centennial Merit Badge)','2016-05-07 12:11:21','2016-05-07 12:11:21'),(143,143,'Scouting Heritage','2016-05-07 12:11:31','2016-05-07 12:11:31'),(144,144,'Inventing','2016-05-07 12:11:53','2016-05-07 12:11:53'),(145,145,'Geocaching','2016-05-07 12:12:08','2016-05-07 12:12:08'),(146,146,'Robotics','2016-05-07 12:12:16','2016-05-07 12:12:16'),(147,147,'Chess','2016-05-07 12:12:33','2016-05-07 12:12:33'),(148,148,'Welding','2016-05-07 12:12:40','2016-05-07 12:12:40'),(149,149,'Kayaking','2016-05-07 12:12:47','2016-05-07 12:12:47'),(150,150,'Search and Rescue','2016-05-07 12:12:55','2016-05-07 12:12:55'),(151,151,'Game Design','2016-05-07 12:13:03','2016-05-07 12:13:03'),(152,152,'Sustainability','2016-05-07 12:13:14','2016-05-07 12:13:14'),(153,153,'Programming','2016-05-07 12:13:21','2016-05-07 12:13:21'),(154,154,'Digital Technology','2016-05-07 12:13:32','2016-05-07 12:13:32'),(155,155,'Mining in Society','2016-05-07 12:13:45','2016-05-07 12:13:45'),(156,156,'Moviemaking','2016-05-07 12:13:56','2016-05-07 12:13:56'),(157,157,'Animation','2016-05-07 12:14:02','2016-05-07 12:14:02'),(158,158,'Signs, Signals, and Codes','2016-05-07 12:14:18','2016-05-07 12:14:18'),(159,159,'Computer-Aided Design','2016-05-07 12:14:38','2016-05-07 12:14:38'),(160,160,'Advanced Computing','2016-05-07 12:14:46','2016-05-07 12:14:46');") );
	}
}
