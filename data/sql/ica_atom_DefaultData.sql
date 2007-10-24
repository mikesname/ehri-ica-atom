-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 24, 2007 at 11:31 AM
-- Server version: 5.0.22
-- PHP Version: 5.2.0

SET FOREIGN_KEY_CHECKS=0;
-- 
-- Database: `ica_atom`
-- 

-- 
-- Dumping data for table `actor`
-- 

INSERT INTO `actor` (`id`, `authorized_form_of_name`, `type_of_entity_id`, `identifiers`, `history`, `legal_status`, `functions`, `mandates`, `internal_structures`, `general_context`, `authority_record_identifier`, `institution_identifier`, `rules`, `status_id`, `level_of_detail_id`, `sources`, `tree_id`, `tree_left_id`, `tree_right_id`, `tree_parent_id`, `created_at`, `updated_at`) VALUES (7, 'City of Vancouver Archives', 7, '', '', '', '', 'The City of Vancouver Archives, a division of the City Clerk''s Department, is responsible for acquiring, organizing and preserving Vancouver''s historical records and making them available to the widest possible audience.', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-18 13:06:45', '2007-10-23 14:28:12'),
(8, 'Vancouver (B.C.). City Council', 7, '', 'The basis for the authority of the City of Vancouver''s City Council is the first Vancouver Act of Incorporation of April 6, 1886 enacted by the Government of the Province of British Columbia. The Act set out the powers, functions, and some procedures relating to the government of the City of Vancouver, and required election of a City Council, the governing body of the local government. Although the City of Vancouver funds the Library, the schools, and the parks, each of these have their own governing boards.\r\n\r\nThe Act of Incorporation (more recently called the Vancouver Charter) has been amended frequently, and is periodically revised and consolidated. The Act has defined the increasing land parameters of Vancouver. In 1886 Vancouver extended from the West End and Alma Road in the west, to Nanaimo Street in the east, and 16th Avenue to the south. In 1911, District Lot 301 and the Townsite of Hastings were annexed (so that Vancouver then extended east to Boundary Road, and south to 25th and 29th Avenues in some areas of the eastern half of the city). Then in 1929, the municipalities of South Vancouver and Point Grey were amalgamated with Vancouver (to result in present-day boundaries to the south and west).\r\n\r\nCity Council''s powers may be exercised by by-law or resolution, according to the provisions of the Charter. Powers have included:\r\n\r\n    * creation and maintenance of "public works" (now often referred to as "the infrastructure")\r\n    * land and building regulation\r\n    * provision of police and fire protection\r\n    * maintaining health standards\r\n    * provision of cultural and recreation services\r\n    * tax collection through property taxes, business licenses, and other fees \r\n\r\nLocal government is responsible to the provincial government, according to the Municipal Act of British Columbia. Some of the relationships with provincial and federal government are intricate, as program requirements are legislated from above, and some program funding is provided by senior governments.\r\n\r\nThe Mayor is the president of Council according to British parliamentary traditions. In order to carry out its functions Council has the authority to determine the internal organization of the governance and bureaucracy. Until 1956 Council was formally involved in all aspects of the operations of the City through the "Council Committee" system. The system was seen as increasingly cumbersome and ineffective, so the Board of Administration was created to take care of managing operations, all the bureaucracy''s administrative and service functions except governance (as of 1974 the Board was replaced by the City Manager). Standing committees, as subdivisions of the major aspects of the business of Council, have always existed.', '', '', '', '', '', '', '', '', 15, 66, '', NULL, NULL, NULL, NULL, '2007-10-18 13:26:40', '2007-10-18 14:07:47'),
(9, 'Vancouver (B.C.). Office of the City Clerk', 7, '', 'The responsibilities of the City Clerk were established with the Act of Incorporation in 1886, which declared the City Clerk to be the Returning Officer of the City (the official responsible for voters'' lists and elections). Additional duties included purchasing supplies and were somewhat undefined. With the clarifications of the 1900 Act of Incorporation, formalized responsibilities included recording Council minutes, keeping custody of the by-laws, and maintaining financial records. The Clerk also received all mail directed to the City. A 1912 by-law assigned responsibility for facilitating communication between the citizens, the Mayor, Council, and Council''s committees to the City Clerk. In a 1953 Act of Incorporation amendment, the Clerk was named as custodian of the City seal. With the exception of financial functions, which long ago passed to financial officers, the Clerk''s responsibilities have remained remarkably consistent. The primary functions over time have been:\r\n\r\n    * taking minutes for the meetings of City Council and related bodies\r\n    * keeping the records of the City of Vancouver as required by the Vancouver Charter\r\n    * carrying out correspondence on behalf of Council\r\n    * keeping all records related to City Council decision making (including large volumes of supporting documents)\r\n    * assembling voters'' lists and carrying out elections (for Council, the Park Board, the School Board, and on plebiscites)\r\n    * providing communication, information, and public relations services, including responsibility for civic ceremonies\r\n    * since 1970, responsibility for the Archives \r\n\r\nFrom 1886 to 1974, the City Clerk reported directly to Council; from 1974 the position has been reporting to the City Manager''s Office. Although the formal organization of the City Clerk''s Department has in recent years consisted of a number of divisions - the Council secretariat, the Voters'' List Division, periodically a small Public Relations/Communications Division, and the Archives and Records Division (since 1970) - in practice, the Office of the City Clerk has included all divisional sections except the Archives. During some periods the Office of the City Clerk was more commonly referred to as the City Clerk''s Office, though the former has prevailed.\r\n\r\nThe following individuals have served as City Clerk:\r\n\r\n    * Thomas Francis McGuigan, 1886-1905\r\n    * Arthur McEvoy, 1905-1907\r\n    * William McQueen, 1907-1931\r\n    * Charles Jones, 1931-1935\r\n    * W. L. Woodford, 1935\r\n    * Fred Howlett, 1935-1945 (acting 1935-1937)\r\n    * Ronald Thompson, 1945-1973\r\n    * Douglas Haig Little, 1973-1978\r\n    * Robert Henry, 1978-1987\r\n    * Maria Kinsella, 1987-1997\r\n    * Ulli Watkiss, 1998-2001\r\n    * Syd Baxter, 2001- \r\n\r\nFor more historical information on the above bodies see the inventory for the City Council and the Office of the City Clerk fonds. Administrative histories for other creators in this fonds (e.g. Airport Board) are given at the series level.', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-18 13:29:21', '2007-10-18 15:45:00'),
(10, 'Townley, Matheson and Partners', 7, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-18 16:04:08', '2007-10-23 14:27:14'),
(11, 'Vancal Reproductions', 7, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-18 17:29:21', '2007-10-23 14:27:42'),
(12, 'City of Rotterdam Archives', 7, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-23 15:45:28', '2007-10-24 11:21:31'),
(13, 'Dr. Koenraad Kuiper', 8, '', 'Director, Blijdorp Zoo', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-23 15:52:20', '2007-10-23 15:52:20'),
(14, 'Rotterdam Zoo Association', 7, '', 'In 1856 two railway bureacrats, Messrs. van den Bergh en van der Valk, rented a railway garden plot in the Rotterdam inner city to maintain their collection of exotic birds.  This hobby led to the establishment of the Rotterdam Zoo Association in 1857. Its first director was Henri Martin, originally a lion tamer by trade.\r\n\r\nAt the same time the zoo expanded. A large apehouse, carnivore building, birdhouse, and reptilehouse were established as the animal and plant collection grew rapidly.  \r\n\r\nIn 1937, the Rotterdam City Council decided that the Zoo had to make way for inner city development. A year later construction began on the new ''Blijdorp'' Zoo in the Blijdorp polder, where Rotterdam''s zoo exists now to this day.', '', '', '', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '2007-10-23 15:53:44', '2007-10-23 16:08:09');

-- 
-- Dumping data for table `actor_name`
-- 

INSERT INTO `actor_name` (`id`, `actor_id`, `name`, `name_type_id`, `name_note`, `created_at`, `updated_at`) VALUES (4, 9, 'City Clerk''s Office', 349, '', '2007-10-18 15:43:47', '2007-10-18 15:43:47'),
(7, 14, 'Vereniging Rotterdamse Diergaarde', 39, '', '2007-10-23 16:02:49', '2007-10-23 16:02:49'),
(8, 12, 'Gemeentearchief Rotterdam', 39, '', '2007-10-23 16:10:21', '2007-10-23 16:10:21');

-- 
-- Dumping data for table `actor_recursive_relationship`
-- 


-- 
-- Dumping data for table `actor_term_relationship`
-- 

INSERT INTO `actor_term_relationship` (`id`, `actor_id`, `term_id`, `relationship_type_id`, `relationship_note`, `relationship_start_date`, `relationship_end_date`, `date_display`, `created_at`, `updated_at`) VALUES (1, 8, 34, 19, NULL, NULL, NULL, NULL, '2007-10-18 14:07:47', '2007-10-18 14:07:47'),
(2, 8, 29, 20, NULL, NULL, NULL, NULL, '2007-10-18 14:07:47', '2007-10-18 14:07:47');

-- 
-- Dumping data for table `contact_information`
-- 

INSERT INTO `contact_information` (`id`, `actor_id`, `contact_type`, `primary_contact`, `street_address`, `city`, `region`, `postal_code`, `country_id`, `longtitude`, `latitude`, `telephone`, `fax`, `website`, `email`, `note`, `created_at`, `updated_at`) VALUES (1, 7, 'office, reference room, storage stacks', 1, '1150 Chestnut Street', 'Vancouver', 'B.C.', 'V6J 3J9', 112, NULL, NULL, '+1 (604) 736-8561 ', '+1 (604) 736-0626', 'http://www.city.vancouver.bc.ca/ctyclerk/archives/', 'archives@vancouver.ca', '', '2007-10-23 14:18:31', '2007-10-23 14:26:30'),
(2, 12, 'office, repository, reading room', 1, 'Hofdijk 651', 'Rotterdam', '', '3032 CG', 224, NULL, NULL, '+31 (0)10 24 34 567 ', '', 'http://www.gemeentearchief.rotterdam.nl', '', NULL, '2007-10-23 15:47:38', '2007-10-23 15:47:38'),
(3, 12, 'mailing address', NULL, 'Postbus 71', 'Rotterdam', '', '3000 AB', 224, NULL, NULL, '', '', '', '', NULL, '2007-10-23 15:48:25', '2007-10-23 15:48:25'),
(4, 12, 'freephone', NULL, '', '', '', '', NULL, NULL, NULL, '+31 (0)800 1545', '', '', '', NULL, '2007-10-23 15:48:54', '2007-10-23 15:48:54');

-- 
-- Dumping data for table `digital_object`
-- 


-- 
-- Dumping data for table `digital_object_metadata`
-- 


-- 
-- Dumping data for table `digital_object_recursive_relationship`
-- 


-- 
-- Dumping data for table `event`
-- 

INSERT INTO `event` (`id`, `name`, `description`, `start_date`, `start_time`, `end_date`, `end_time`, `date_display`, `event_type_id`, `actor_role_id`, `information_object_id`, `actor_id`, `created_at`, `updated_at`) VALUES (28, NULL, '1886-2003, predominant 1886-1993', '1886-01-01', NULL, '2003-01-01', NULL, NULL, 341, 344, 11, 9, '2007-10-18 13:29:21', '2007-10-18 13:29:21'),
(29, NULL, '1886 - 1976', '1886-01-01', NULL, '1976-01-01', NULL, NULL, 341, NULL, NULL, NULL, '2007-10-18 13:40:09', '2007-10-18 13:40:09'),
(30, NULL, '1886-1976', '1886-01-01', NULL, '1976-01-01', NULL, NULL, 341, NULL, NULL, NULL, '2007-10-18 13:40:45', '2007-10-18 13:40:45'),
(31, NULL, '1886-1976', '1886-01-01', NULL, '1976-01-01', NULL, NULL, 341, 344, 13, 9, '2007-10-18 13:41:23', '2007-10-18 13:41:23'),
(32, NULL, '1886-1976', '1886-01-01', NULL, '1976-01-01', NULL, NULL, 341, NULL, NULL, NULL, '2007-10-18 13:41:48', '2007-10-18 13:41:48'),
(33, NULL, '1886-2003, predominant 1886-1993', '1886-01-01', NULL, '2003-01-01', NULL, NULL, 341, 344, 11, 8, '2007-10-18 14:02:28', '2007-10-18 14:02:28'),
(36, NULL, '1883-2006', '1883-01-01', NULL, '2006-01-01', NULL, NULL, 341, NULL, NULL, NULL, '2007-10-18 14:47:27', '2007-10-18 14:47:27'),
(37, NULL, '1886-1976', '1886-01-01', NULL, '1976-01-01', NULL, NULL, 341, NULL, NULL, NULL, '2007-10-18 15:33:18', '2007-10-18 15:33:18'),
(39, NULL, '1897-[ca. 1990]; predominant 1919-1974', '1897-01-01', NULL, '1990-01-01', NULL, NULL, 341, 344, 18, 10, '2007-10-18 16:05:19', '2007-10-18 16:05:19'),
(40, NULL, '1897 - 1977', '1897-01-01', NULL, '1977-01-01', NULL, NULL, 341, NULL, 19, NULL, '2007-10-18 17:07:53', '2007-10-18 17:07:53'),
(41, NULL, '[1935]', '1935-01-01', NULL, '0000-00-00', NULL, NULL, 341, NULL, 20, NULL, '2007-10-18 17:18:45', '2007-10-18 17:18:45'),
(42, NULL, '1967 - 1968', '1967-01-01', NULL, '1968-01-01', NULL, NULL, 341, NULL, 21, NULL, '2007-10-18 17:25:12', '2007-10-18 17:25:12'),
(44, NULL, '1968', '1968-01-01', NULL, '0000-00-00', NULL, NULL, 341, 344, 22, 11, '2007-10-18 17:29:21', '2007-10-18 17:29:22'),
(45, NULL, '1988 - ', '1988-01-01', NULL, '0000-00-00', NULL, NULL, 352, NULL, NULL, 11, '2007-10-19 11:12:22', '2007-10-23 14:27:42'),
(46, NULL, '1888 - 1971', '1888-01-01', NULL, '1971-01-01', NULL, NULL, 352, NULL, NULL, 13, '2007-10-23 15:52:20', '2007-10-23 15:52:20'),
(47, NULL, '1854 - 1939', '1854-01-01', NULL, '1939-01-01', NULL, NULL, 352, NULL, NULL, 14, '2007-10-23 15:54:31', '2007-10-23 16:08:10'),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 344, 24, 13, '2007-10-23 15:55:27', '2007-10-23 15:55:27'),
(49, NULL, '1854 - 1939', '1854-01-01', NULL, '1939-01-01', NULL, NULL, 341, 344, 23, 14, '2007-10-23 16:09:29', '2007-10-23 16:09:29');

-- 
-- Dumping data for table `event_term_relationship`
-- 


-- 
-- Dumping data for table `function_description`
-- 


-- 
-- Dumping data for table `historical_event`
-- 


-- 
-- Dumping data for table `information_object`
-- 

INSERT INTO `information_object` (`id`, `identifier`, `title`, `alternateTitle`, `version`, `level_of_description_id`, `extent_and_medium`, `archival_history`, `acquisition`, `scope_and_content`, `appraisal`, `accruals`, `arrangement`, `access_conditions`, `reproduction_conditions`, `physical_characteristics`, `finding_aids`, `location_of_originals`, `location_of_copies`, `related_units_of_description`, `rules`, `collection_type_id`, `repository_id`, `tree_id`, `tree_left_id`, `tree_right_id`, `tree_parent_id`, `created_at`, `updated_at`) VALUES (11, '', 'City Council and Office of the City Clerk fonds', '', '', 319, 'ca. 320 m of textual records\r\nca. 4,000 photographs\r\n13 videocassettes', '', '', 'Fonds includes the records of City Council of the City of Vancouver, of the Office of the City Clerk (Council''s secretariat), of elections and public relations divisions (both very small, and the elections division in operation only during election periods), and of the numerous committees, boards, and commissions whose records were/are the responsibility of the City Clerk.  The fonds does not include the records of the Archives because it operates like a research institution (see the City of Vancouver Archives fonds). The series below are listed alphabetically by the creating office.  The City''s primary governing records are created by Council, under "Vancouver (B.C.). City Council" (by-laws, Council minutes, etc.), while the supporting documents to City Council records are within the series of the Clerk''s, under "Vancouver (B.C.). Office of the City Clerk".  The official records of the various boards are considered to be created by those boards (e.g. Airport Board).  Please note that the minutes of standing committees of Council are appended to Council minutes as of 1951.', '', '', '', '', '', '', 'Series descriptions and file lists available.', '', '', 'Pre-1911 records for the former Hastings   Townsite are held at the B.C. Archives.\r\n\r\nFor South Vancouver and Point Grey municipality Council, City Clerk''s, and all other retained archival records dating from before amalgamation with the City of Vancouver in 1929, see the Corporation of the District of South Vancouver fonds and the Corporation of Point Grey fonds. The offices forming City Council, the mayor and aldermen (now called councillors), are arranged as the Mayor''s Office fonds and the Councillors''office fonds.', '', NULL, 5, 11, -1, 6, NULL, '2007-10-18 13:25:04', '2007-10-19 06:59:51'),
(12, '', 'Office of the City Clerk sous fonds', '', '', 320, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 11, 0, 3, 11, '2007-10-18 13:37:31', '2007-10-19 06:59:16'),
(13, '', 'Subject files - including Council supporting documents', '', '', 321, '102.3 m of textual records\r\nca. 50 photographs', '', 'Records from 1886-1955 were transferred from the Voters List building, Yukon Street, in 1971 and from the City Clerk''s vault and vault no. 2, City Hall, in 1972.', 'Series consists of administrative and operational files on any matters dealt with by the Office of the City Clerk over time, in its and the individual Clerks'' roles as Council secretariat, elections office(r), and information office(r).  The scope of City and outside bodies represented, the topics covered, and the types of records contained (primarily correspondence, but also including minutes, contracts, grant applications, etc.) is immense.  There is a problem of organization with Office of the City Clerk''s files in that, during some periods, files contained here were organized separately (therefore are separate series), while during other periods, those same files were integrated here (e.g. Traffic Commission, Council committees, etc.)  Database searching alleviates the problem.  Arranged in annual sets (date ranges filed by latest year represented) and therein alphabetically by file title (please note that there is tremendous inconsistency in file title formulation during some periods, see arrangement note below).', '', 'No futher accruals are expected.', 'The filing system was not followed consistently with the result that letters on one subject may be found under a variety of headings (for example, letters concerning the British Columbia Sugar Refining Company may be filed under "B" for "British Columbia", "S" for "sugar", or "R" for "B.T. Rogers").  Please note also that every year has files designated "Alphabetical file", which contain correspondence from organizations and individuals who were not assigned a separate subject file (and there is filing inconsistency here as well, i.e. a subject file may exist, yet some items pertaining to that subject ended up in "Alphabetical file").', 'Some files less than 100 years old restricted for privacy reasons; please consult the archivist.', '', '', 'File list available.', '', 'Early files (most to 1918) have been microfilmed (MCR 3 and M 107 as indicated on boxes in stacks).', 'Series 29 (Outward correspondence, 1886-1975)is the counterpart to this series which was formerly called "Inward correspondence",\r\nhowever, series 29 consists solely of letter press books containing the Clerk''s outgoing correspondence and this series contains every other document on a given subject including (variously complete) outward correspondence (once the approximate date of a given subject has been identified from series 20, researchers might wish to consult that period in series 29); this series subdivided after 1974 (as scheduled at that time), therefore continued by series 60 (Housekeeping subject files, selected files only retained by Archives) and series 62 (Operational subject\r\nfiles, all retained).', '', NULL, NULL, 11, 1, 2, 12, '2007-10-18 13:38:22', '2007-10-19 06:59:16'),
(15, '', 'City Council sous fonds', '', '', 320, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 11, 4, 5, 11, '2007-10-18 14:42:29', '2007-10-19 06:59:51'),
(18, 'MSS 1399', 'Townley, Matheson and Partners', NULL, '', 319, 'ca. 5000 architectural drawings\r\n653 photographs\r\n44 cm textual material', 'The records were created and maintained at the offices of Townley, Matheson and Partners until the dissolution of the partnership in 1974. After the dissolution of the partnership they were maintained in the custody of Allen C. Kelly until his death in 2001. The records were part of Kelly''s estate, and were donated to the archives by his daughter Morna Horner in 2002. Records created before 1919 are from Townley''s and Matheson''s respective work before forming the partnership, and were likely transfered into the partnership''s custody at or shortly after its creation.', '', 'The fonds consists of architectural drawings, photographs and textual materials related to the partnership''s activities surrounding the design and implementation of architectural projects. The majority of the records are graphical in nature. Architectural drawing files specific to a particular project typically contain elevation and perspective drawings related to the design of an initial concept and proposal for the project, incorporations of revisions into the initial concept based on the clients input and practical considerations, detailed plans intended to guide construction work, and annotations and alterations to those plans made during construction. Some of the projects (approximately 1 in 10) did not receive approval to proceede, and contain material relating only to the initial proposal. Project photographs include pre- construction photos taken of the construction site used to assist in the initial planning, progress photographs used in the supervision of construction, as documentation of the techniques and practices used during construction and for reference purposes, and post construction photographs used to document the finished appearance of a project. Photographs were also incorporated into promotional material, as collections of albums shown to prospective clients, and in promotional publications. The majority of the records relate to projects in the greater Vancouver area. Approximately 100 projects were undertaken on Vancouver Island, primarially in the Victoria  region, but also in Duncan, Ladysmith, and Nanaimo.There are also records related to hospital projects in the Fraser Valley, several residences in the Okanagan, as well as two hospital projects in Lethbridge Alta.\r\n\r\nProjects initiated between 1919 and 1966 were numbered sequentially as job no. 1 through 1047. Jobs located in Victoria (B.C.) worked on between 1929 and ca. 1932 were numbered sequentially as job no. V-1 through V-14. Two jobs done in Penticton (B.C.) in 1936 are numbered sequentially as job nos. M-1 and M-2. Begining in 1967, projects were assigned a 5 digit job number; the first 2 digits of the job number were the last 2 digits of the calendar year, followed by a hyphen and a 3 digit number (e.g. 67-014). Where known, job nos. have been incorporated into titles at the file and item levels.', '', '', '', 'Access restrictions apply to some of the records, please consult the archivist', '', '', '', '', '', '', '', NULL, 5, 18, -1, 8, NULL, '2007-10-18 16:01:56', '2007-10-23 15:19:56'),
(19, '', 'Architectural drawings', '', '', 321, 'ca. 5000 architectural drawings', '', '', 'Series consists of drawings created in the course of designing architectural projects that reflect the creation of initial concepts and proposals, refinement and revision of the proposal, the production of working plans for building contractors, and alterations made to plans during the construction process. The drawings include lot plans, elevations, floor plans, perspective drawings and building schedules, representing approximately 700 of the 1100+ architectural projects that Townley, Matheson and Partners were responsible for. The series includes drawings by both Townley and Matheson completed prior to the formation of the partnership.', '', '', 'Drawings were stored by Townley and Matheson rolled on wooden dowels with one project spanning one or more dowels. They have been arranged into files on this basis. In cases where drawings for a project span multiple dowels, each dowel has been described as a discreet file. Some files were housed on dowels that did not have a label; those files for which a job no. could not be established were assigned an "unidentified roll number" (UN #) in the location field of the file level description. The assignment of the UN # is arbitrary and is unrelated to the arrangement of the series.', 'Access restrictions apply, please consult the archivist.', '', '', '', '', '', 'Job cards exist for most of the files in this series. Refer to "Job card index" file within the miscellaneous records series.', '', NULL, NULL, 18, 0, 7, 18, '2007-10-18 17:07:04', '2007-10-18 17:24:53'),
(20, '', 'Job no. 575 : owner Standard Stations Ltd., station #2 B.C., Georgia & Main, [Vancouver]', '', '', 323, '', '', '', '', '', '', '', 'Access to drawings may be delayed for conservation or privacy reasons.  Please consult the archivist.', '', '', '', '', '', '', '', NULL, NULL, 18, 1, 2, 19, '2007-10-18 17:18:02', '2007-10-18 17:20:00'),
(21, '', 'Job no. 67-010 : [plans for proposed hotel for L.B. Johnson & Sons Holding Co. Ltd., corner of Robson St. and Howe St., Vancouver B.C.]', '', '', 323, '27 microfiche : b&w polyester negative ; 11 x 16 cm', '', '', 'File contains floor plans and perspective drawings for a proposed hotel. The draings give two names for the hotel: Grosvenor Hotel and York Hotel. The bulding depicted in the drawings was never built.', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 18, 3, 6, 19, '2007-10-18 17:23:53', '2007-10-18 17:27:35'),
(22, '', '[Job no. 67-010] : Grosvenor Hotel, Howe and Robson Streets, Vancouver B.C. : typical upper floor plan', '', '', 324, '2 microfiche : b&w polyester negative ; 11 x 16 cm', '', '', 'Mircrofiche of architectural drawing.', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 18, 4, 5, 21, '2007-10-18 17:27:35', '2007-10-18 17:30:18'),
(23, '21', 'Rotterdam Zoo Association fonds', 'FONDS 21 Vereniging Rotterdamse Diergaarde fonds', '', 319, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 6, 23, 1, 22, NULL, NULL, '2007-10-23 16:17:13'),
(24, '20.05', 'Dr. Koenraad Kuiper fonds', '', '', 319, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 6, NULL, NULL, NULL, NULL, NULL, '2007-10-23 16:18:56'),
(25, '21.1', 'Stukken van algemene aard', '', '', 321, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 2, 9, 23, NULL, '2007-10-23 16:14:45'),
(26, '21.1.1', 'Notulen, correspondentie en jaarverslagen', '', '', 322, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 3, 4, 25, NULL, '2007-10-23 16:13:41'),
(27, '21.1.2', 'Regulations, agreements, publications, etc', '', '', 322, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 5, 6, 25, NULL, '2007-10-23 16:14:17'),
(28, '21.1.3', 'Miscellaneous', '', '', 322, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 7, 8, 25, NULL, '2007-10-23 16:14:45'),
(29, '21.2', 'Personel Records', '', '', 321, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 10, 15, 23, NULL, '2007-10-23 16:18:22'),
(30, '21.3', 'Financial Records', '', '', 321, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 16, 17, 23, NULL, '2007-10-23 16:15:55'),
(31, '21.4', 'Property Records', '', '', 321, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 18, 19, 23, NULL, '2007-10-23 16:16:30'),
(32, '21.5', 'Ephemera', '', '', 321, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 20, 21, 23, NULL, '2007-10-23 16:17:13'),
(33, '21.2.1', 'General', '', '', 322, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 11, 12, 29, NULL, '2007-10-23 16:17:50'),
(34, '21.2.2', 'Pension and Relief Fund', '', '', 322, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 23, 13, 14, 29, NULL, '2007-10-23 16:18:22');

-- 
-- Dumping data for table `information_object_recursive_relationship`
-- 


-- 
-- Dumping data for table `information_object_term_relationship`
-- 

INSERT INTO `information_object_term_relationship` (`id`, `information_object_id`, `term_id`, `relationship_type_id`, `relationship_note`, `relationship_start_date`, `relationship_end_date`, `date_display`, `created_at`, `updated_at`) VALUES (16, 11, 34, 335, NULL, NULL, NULL, NULL, '2007-10-18 13:32:19', '2007-10-18 13:32:19'),
(17, 11, 29, 334, NULL, NULL, NULL, NULL, '2007-10-18 13:32:19', '2007-10-18 13:32:19'),
(18, 11, 346, 336, NULL, NULL, NULL, NULL, '2007-10-18 13:33:37', '2007-10-18 13:33:37'),
(19, 11, 347, 336, NULL, NULL, NULL, NULL, '2007-10-18 13:33:55', '2007-10-18 13:33:55'),
(20, 13, 34, 335, NULL, NULL, NULL, NULL, '2007-10-18 13:51:14', '2007-10-18 13:51:14'),
(21, 13, 29, 334, NULL, NULL, NULL, NULL, '2007-10-18 13:51:14', '2007-10-18 13:51:14'),
(22, 13, 346, 336, NULL, NULL, NULL, NULL, '2007-10-18 13:54:52', '2007-10-18 13:54:52'),
(23, 13, 347, 336, NULL, NULL, NULL, NULL, '2007-10-18 13:55:01', '2007-10-18 13:55:01'),
(24, 11, 346, 336, NULL, NULL, NULL, NULL, '2007-10-18 14:32:40', '2007-10-18 14:32:40'),
(25, 18, 34, 335, NULL, NULL, NULL, NULL, '2007-10-18 16:07:21', '2007-10-18 16:07:21'),
(26, 18, 29, 334, NULL, NULL, NULL, NULL, '2007-10-18 16:07:21', '2007-10-18 16:07:21'),
(27, 19, 34, 335, NULL, NULL, NULL, NULL, '2007-10-18 17:15:57', '2007-10-18 17:15:57'),
(28, 19, 29, 334, NULL, NULL, NULL, NULL, '2007-10-18 17:15:57', '2007-10-18 17:15:57'),
(29, 19, 351, 336, NULL, NULL, NULL, NULL, '2007-10-18 17:16:47', '2007-10-18 17:16:47'),
(30, 24, 353, 336, NULL, NULL, NULL, NULL, '2007-10-23 15:56:47', '2007-10-23 15:56:47'),
(31, 23, 353, 336, NULL, NULL, NULL, NULL, '2007-10-23 17:04:46', '2007-10-23 17:04:46'),
(32, 24, 37, 335, NULL, NULL, NULL, NULL, '2007-10-24 11:19:28', '2007-10-24 11:19:28'),
(33, 23, 37, 335, NULL, NULL, NULL, NULL, '2007-10-24 11:19:54', '2007-10-24 11:19:54');

-- 
-- Dumping data for table `map`
-- 


-- 
-- Dumping data for table `menu`
-- 


-- 
-- Dumping data for table `note`
-- 

INSERT INTO `note` (`id`, `information_object_id`, `actor_id`, `repository_id`, `function_description_id`, `note`, `note_type_id`, `user_id`, `created_at`, `updated_at`) VALUES (8, 11, NULL, NULL, NULL, 'Title based on provenance of fonds.', 317, 1, '2007-10-18 13:25:04', '2007-10-18 13:25:04'),
(9, 12, NULL, NULL, NULL, 'Title supplied by archivist.', 317, 1, '2007-10-18 13:37:31', '2007-10-18 13:37:31'),
(11, 13, NULL, NULL, NULL, 'Title based on characteristics of records.', 317, 1, '2007-10-18 13:43:36', '2007-10-18 13:43:36'),
(13, 13, NULL, NULL, NULL, 'The over 8,000 file titles in this series were previously known by several series titles, as follows. Files located at bays 10,13-20, 67-68, 88-90, 82, 142-143, 22 and 27 were previously known as "Inward correspondence, 1886-1975" (series 20); files located at bays 16-22 were previously known as "Operational files, predominant 1971-1975" (series 21); files located at bays 81, 79, 141-142 were previously known as "Special subjects, predominant 1962-1972" (series 23); files located at boxes 42-B-7, 80-C-7, and shelf 80-D were previously known as "Standing Committee on Finance and Administration subject files, 1962-1970 (series 25); files located at boxes 142-C-5 to 142-C-6 (files 1-3) were previously known as "Standing Committee on Planning and Development subject files, 1969-1975" (series 26); files located at shelf 82-A were previously known as "From the City Clerk''s Office, predominant 1935-1966" (series 57); files located at boxes 594-A-8, 594-B-5 and 594-C-1 were previously known as "McGuigan family fonds" (Add.MSS 920, City Clerk''s Office, Inward correspondence).', 52, 1, '2007-10-18 14:50:38', '2007-10-18 14:50:38'),
(14, 18, NULL, NULL, NULL, 'Title based on name of creator', 317, 1, '2007-10-18 16:01:56', '2007-10-18 16:01:56'),
(15, 18, NULL, NULL, NULL, 'Partial funding for this project was provided\r\n             by the Canadian Council of Archives through a 2003-2004 Control of Holdings grant.', 52, 1, '2007-10-18 16:07:36', '2007-10-18 16:07:36'),
(16, 19, NULL, NULL, NULL, 'Title based on contents of series', 317, 1, '2007-10-18 17:07:04', '2007-10-18 17:07:04'),
(17, 20, NULL, NULL, NULL, 'Title taken from job index card.', 317, 1, '2007-10-18 17:18:02', '2007-10-18 17:18:02'),
(18, 20, NULL, NULL, NULL, 'On job card: "Contractor George Snider". Building has been demolished.', 53, 1, '2007-10-18 17:20:18', '2007-10-18 17:20:18'),
(19, 21, NULL, NULL, NULL, 'Title based on contents of file.', 317, 1, '2007-10-18 17:23:53', '2007-10-18 17:23:53'),
(20, 22, NULL, NULL, NULL, 'Drawing spans 2 fiche.', 53, 1, '2007-10-18 17:30:34', '2007-10-18 17:30:34');

-- 
-- Dumping data for table `physical_object`
-- 


-- 
-- Dumping data for table `place`
-- 


-- 
-- Dumping data for table `place_map_relationship`
-- 


-- 
-- Dumping data for table `repository`
-- 

INSERT INTO `repository` (`id`, `actor_id`, `identifier`, `repository_type_id`, `officers_in_charge`, `geocultural_context`, `collecting_policies`, `buildings`, `holdings`, `finding_aids`, `opening_times`, `access_conditions`, `disabled_access`, `transport`, `research_services`, `reproduction_services`, `public_facilities`, `description_identifier`, `institution_identifier`, `rules`, `status_id`, `level_of_detail_id`, `sources`, `created_at`, `updated_at`) VALUES (5, 7, '', 350, 'Heather Gordon, Archives Manager', '', '', '', 'Holdings include:\r\n    * City of Vancouver government records (public records)\r\n    * Records of non-government organizations, businesses and individuals (private records)\r\n    * Visual records including historic photographs, maps, etc. ', '', 'Monday through Friday:\r\nReading Room open 9:00 am to 5:00 pm.\r\nStaff assistance 10:00 am to 4:45 pm.\r\nClosed statutory and civic holidays.', '', 'The ground level entrance is located on the northeast side of the building at the end of a concrete walkway which leads from the designated parking spaces. Washrooms are wheelchair accessible.', 'The #22 Macdonald (westbound) and #22 Knight (eastbound) buses stop along Cornwall Avenue which is a four-block walk from the Archives.', 'The City of Vancouver Archives receives inquiries by conventional mail, FAX, and electronic means. Due to the volume of requests we receive, we are unable to undertake extensive research requests. If you have a specific question about a particular subject, individual or archival holding, we will endeavour to respond to your inquiry in a timely manner. Please note, however that response time may be affected by heavy workloads. If you are planning a visit or have a time-sensitive project, please keep this in mind.\r\n\r\nIf you are sending your inquiry electronically , please include your mailing address so we can respond appropriately. If you live in the area, please also include your telephone number.', 'Copies of many of the records held by the Archives may be obtained as:\r\n    * photographic reproduction services (information, price list, order form)\r\n    * photocopies (30 cents per copy)\r\n    * micrographic copies (55 cents per copy) \r\n\r\nPrices for other reproductions are available upon request. Reproductions are available subject to copyright, legal, conservation or depositor restrictions.', 'A spacious reading room with a spectacular view of English Bay is open to all for in-house research. Here you will find:\r\n    * in-house finding aids\r\n    * reference materials\r\n    * self-serve materials in microform\r\n    * a computer terminal for searching our database ', '', '', '', 15, 66, '', '2007-10-18 13:06:45', '2007-10-23 14:18:31'),
(6, 12, '', 350, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '2007-10-23 15:45:28', '2007-10-23 15:45:28');

-- 
-- Dumping data for table `repository_term_relationship`
-- 

INSERT INTO `repository_term_relationship` (`id`, `repository_id`, `term_id`, `relationship_type_id`, `relationship_note`, `created_at`, `updated_at`) VALUES (1, 5, 34, 63, NULL, '2007-10-18 13:19:01', '2007-10-18 13:19:01'),
(2, 5, 29, 64, NULL, '2007-10-18 13:19:01', '2007-10-18 13:19:01');

-- 
-- Dumping data for table `right`
-- 


-- 
-- Dumping data for table `right_actor_relationship`
-- 


-- 
-- Dumping data for table `right_term_relationship`
-- 


-- 
-- Dumping data for table `static_page`
-- 

INSERT INTO `static_page` (`id`, `title`, `permalink`, `page_content`, `stylesheet`, `created_at`, `updated_at`) VALUES (1, 'Homepage', 'homepage', '<h1 id="first">Welcome</h1>\r\nThis is the homepage for the default installation of ICA-AtoM v0.4. This is an early beta version that is still under active development and testing.\r\n\r\nICA-AtoM is a fully web-based archival description application that is based on <a href="http://www.ica.org">International Council on Archives</a> (ICA) standards. <i>AtoM</i> is an acronymn for <i>Access to Memory</i>.\r\n\r\nThe ICA and its <a href="http://ica-atom.org/partners.html">project collaborators</a> are making this application available as open-source software to provide archival institutions with a free and easy-to-use option for putting their archival collections online. See the <a href="about">about page</a> to learn more about the ICA-AtoM project.\r\n\r\nSee the online <a href="http://ica-atom.org/docs">documentation wiki</a> to learn more about using the software or press the <i>browse</i> button on the right to view some sample data.', '', '2006-09-11 12:52:39', '2007-10-23 17:10:01'),
(13, 'about', 'about', '<h1 id="first">About</h1>\r\nThis is the <b>About</b> page for the default installation of ICA-AtoM, open-source archival description software.\r\n\r\nSee the online <a href="http://ica-atom.org/docs">documentation wiki</a> to learn how to get started with ICA-AtoM, including how to customize and edit this page.\r\n\r\n<h1>About the ICA-AtoM Project</h1>\r\nICA-AtoM is a <a href="http://ica-atom.org/partners.html">collaborative project</a> with the aim to provide the international archival community with a free, open-source software application to manage archival descriptions in accord with ICA standards. \r\n\r\nThe goal is to provide an easy-to-use, multi-lingual application that is fully web-based and will allow institutions to make their archival collections available online.', '', '2007-07-10 14:45:50', '2007-10-23 15:00:40');

-- 
-- Dumping data for table `system_event`
-- 


-- 
-- Dumping data for table `taxonomy`
-- 

INSERT INTO `taxonomy` (`id`, `name`, `term_use`, `note`, `created_at`, `updated_at`) VALUES (1, 'ActorRecursiveRelationshipType', 'admin', 'As required by ISAAR(CPF), indicates the type of relationship which exists between two actors described in the authority files (e.g. hierarchical, temporal, family, associative).', NULL, NULL),
(2, 'ActorRole', 'admin', 'Describes the role which the Actor plays in relation to the related informationObject (e.g. creator, author, custodian, copyright owner, owner, etc.)', NULL, NULL),
(3, 'AuthorityFileDetail', 'user', 'As required by ISAAR(CPF), indicates the level of detail to which the authority file is completed (e.g. minimal, partial, or full)', NULL, NULL),
(4, 'AuthorityFileEntityType', 'user', 'As required by ISAAR(CPF), indicates the type of entity that is described in the authority file (e.g. corporate body, person, or family).', NULL, NULL),
(5, 'AuthorityFileStatus', 'user', 'As required by ISAAR(CPF), indicates the drafting status of the authority file (e.g. draft, finalized, revised, or deleted)', NULL, NULL),
(6, 'Country', 'admin', 'Country names and codes. Original values derived from ISO 3166 (code_alpha = ISO 3166-1, code_alpha2 = ISO 3166-2, code_numeric = ISO 3166-numeric)', NULL, NULL),
(7, 'LevelOfDescription', 'user', 'The hierarchical levels of archival description as prescribed by ISAD (e.g. fonds, series, file, item).', NULL, NULL),
(8, 'GeographicRegion', 'user', 'Global or regional area (other than formal continent, country, province or city names) which is used to describe a geographic location. The original values for these terms were derived from the ICA''s list of Regional Branches.', NULL, NULL),
(9, 'InstitutionCategory', 'user', 'The type of institution which is providing access to archival holdings. The original values for these terms were derived from the UNESCO Archives Portal categories for archival repositories.', NULL, NULL),
(10, 'Language', 'user', 'Language names and codes. Original values derived from ISO 639. (alpha_code = ISO 639-1, alpha_code2 = ISO 639-2)', NULL, NULL),
(11, 'MaterialType', 'admin', 'used to differentiate archival material from bibliographic material and other object types at the highest level (e.g. artifacts) ', NULL, NULL),
(12, 'MediaType', 'user', 'The format or genre of archival material. Also referred to as ''General Material Designation'' or ''Resource Type'' in some standards. The initial values for Media Type were derived from the  OAIster service which has a mapping  of 365 different formats and genres to these 5 core values: text, image, video, audio, dataset (see http://oaister.umdl.umich.edu/o/oaister/docs/normal_types.txt)', NULL, NULL),
(13, 'Script', 'user', 'Script names and codes. Original values derived from ISO 15924.', NULL, NULL),
(14, 'Subject', 'user', 'Terms which can be used as subject access points to describe archival material', NULL, NULL),
(15, 'UserCredential', 'admin', 'User credentials define roles and associated permissions to carry out tasks in the ICA-AtoM application.', NULL, NULL),
(16, 'UserTermRelationshipType', 'admin', 'categorizes the nature of relationships between User and Term objects', NULL, NULL),
(17, 'ActorTermRelationshipType', 'admin', NULL, NULL, NULL),
(18, 'ActorNameTypes', 'user', NULL, NULL, NULL),
(19, 'NoteType', 'user', NULL, NULL, NULL),
(20, 'RepositoryType', 'user', 'see ISIAH 5.1.5', NULL, NULL),
(22, 'RepositoryTermRelationshipType', 'admin', NULL, NULL, NULL),
(24, 'CollectionType', 'admin', NULL, NULL, NULL),
(25, 'InformationObjectTermRelationshipType', 'admin', NULL, NULL, NULL),
(26, 'EventType', 'admin', 'used to describe the types of Events that occur between Actors and InformationObjects', NULL, NULL);

-- 
-- Dumping data for table `term`
-- 

INSERT INTO `term` (`id`, `taxonomy_id`, `term_name`, `scope_note`, `code_alpha`, `code_alpha2`, `code_numeric`, `sort_order`, `source`, `locked`, `tree_id`, `tree_left_id`, `tree_right_id`, `tree_parent_id`, `created_at`, `updated_at`) VALUES (2, 15, 'contributor', NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 15, 'editor', NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 15, 'translator', NULL, NULL, NULL, NULL, 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 15, 'administrator', NULL, NULL, NULL, NULL, 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 16, 'credential', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 4, 'Corporate Body', '', '', '', NULL, 1, 'ISAAR(CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-17 16:53:56', '2007-09-17 16:53:56'),
(8, 4, 'Person', '', '', '', NULL, 2, 'ISAAR(CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-17 16:54:26', '2007-09-17 16:54:26'),
(9, 4, 'Family', '', '', '', NULL, 3, 'ISAAR(CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-17 16:54:43', '2007-09-18 12:45:47'),
(11, 3, 'Full', '', '', '', NULL, 1, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-18 12:47:29', '2007-09-18 12:47:29'),
(15, 5, 'Final', '', '', '', NULL, 1, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-18 13:49:36', '2007-09-18 13:49:36'),
(16, 5, 'Revised', '', '', '', NULL, 2, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-18 13:49:53', '2007-09-18 13:49:53'),
(17, 5, 'Draft', '', '', '', NULL, 3, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-18 13:50:16', '2007-09-18 13:50:16'),
(18, 5, 'Deleted', '', '', '', NULL, 4, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-18 13:50:33', '2007-09-18 13:50:33'),
(19, 17, 'Language of Authority File', NULL, NULL, NULL, NULL, NULL, 'ISAAR(CPF) 5.4.7', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 17, 'Script of Authority File', NULL, NULL, NULL, NULL, NULL, 'ISAAR(CPF) 5.4.7', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 13, 'Arabic', NULL, 'arab', NULL, 160, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 13, 'Braille', NULL, 'brai', NULL, 570, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 13, 'Cyrillic', NULL, 'cyrl', NULL, 220, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 13, 'Egyptian hieroglyphs', NULL, 'egyp', NULL, 50, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 13, 'Gothic', NULL, 'goth', NULL, 206, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 13, 'Greek', NULL, 'grek', NULL, 200, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 13, 'Hebrew', NULL, 'hebr', NULL, 125, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 13, 'Japanese', NULL, 'jpan', NULL, 413, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 13, 'Latin', NULL, 'latn', NULL, 215, NULL, 'ISO 15924', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 10, 'English', '', 'en', 'eng', NULL, 1, 'ISO 639-2', NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-19 12:48:56'),
(35, 10, 'French', '', 'fr', 'fre', NULL, 2, 'ISO 639-2', NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-19 12:49:08'),
(36, 10, 'Spanish', '', 'es', 'spa', NULL, 3, 'ISO 639-2', NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-19 12:49:18'),
(37, 10, 'Dutch', '', 'nl', 'dut', NULL, 4, 'ISO 639-2', NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-19 12:49:25'),
(38, 10, 'Italian', '', 'it', 'ita', NULL, 5, 'ISO 639-2', NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-19 12:49:35'),
(39, 18, 'Parrallel Form', '', '', '', NULL, 1, 'ISAAR (CPF) 5.1.3', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:07:33', '2007-09-20 15:20:42'),
(40, 18, 'Standardized Form', '', '', '', NULL, 2, 'ISAAR (CPF) 5.1.4', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:09:33', '2007-09-20 15:20:32'),
(41, 18, 'Pseudonym', '', '', '', NULL, 5, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:16:52', '2007-10-18 15:20:58'),
(42, 18, 'Acronym', '', '', '', NULL, 6, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:19:48', '2007-10-18 15:20:46'),
(43, 18, 'Title', '', '', '', NULL, 7, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:21:00', '2007-10-18 15:20:40'),
(44, 18, 'Family Name', '', '', '', NULL, 8, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:21:13', '2007-10-18 15:20:33'),
(45, 18, 'Maiden Name', '', '', '', NULL, 9, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:21:26', '2007-10-18 15:20:26'),
(46, 18, 'First Name', '', '', '', NULL, 10, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:21:46', '2007-10-18 15:20:20'),
(47, 18, 'Middle Name(s)', '', '', '', NULL, 11, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:21:59', '2007-10-18 15:20:13'),
(48, 18, 'Initials', '', '', '', NULL, 12, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:22:22', '2007-10-18 15:20:06'),
(49, 18, 'Nickname', '', '', '', NULL, 13, '', NULL, NULL, NULL, NULL, NULL, '2007-09-19 17:23:16', '2007-10-18 15:19:59'),
(50, NULL, 'Maintenance Note', '', '', '', NULL, 4, 'ISAAR(CPF) 5.4.9', NULL, NULL, NULL, NULL, NULL, '2007-09-20 16:58:34', '2007-10-01 17:15:51'),
(51, 19, 'Publication Note', '', '', '', NULL, 4, 'ISAD(G) 3.5.4', NULL, NULL, NULL, NULL, NULL, '2007-09-20 17:23:40', '2007-10-02 11:28:21'),
(52, 19, 'Archivist''s Note', '', '', '', NULL, 3, 'ISAD(G) 3.7.1', NULL, NULL, NULL, NULL, NULL, '2007-09-20 17:24:01', '2007-10-02 11:28:16'),
(53, 19, 'General Note', '', '', '', NULL, 2, 'ISAD(G) 3.6.1', NULL, NULL, NULL, NULL, NULL, '2007-09-20 17:25:00', '2007-10-02 11:28:10'),
(55, 20, 'International', '', '', '', NULL, 1, '', 1, NULL, NULL, NULL, NULL, '2007-09-21 16:46:38', '2007-09-21 16:46:57'),
(56, 20, 'National', '', '', '', NULL, 2, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:46:51', '2007-09-21 16:46:51'),
(57, 20, 'Provincial/State', '', '', '', NULL, 3, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:47:12', '2007-09-21 16:47:12'),
(58, NULL, 'Regional', '', '', '', NULL, 4, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:47:23', '2007-10-01 17:18:01'),
(59, NULL, 'City/Municipal', '', '', '', NULL, 5, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:47:38', '2007-10-01 17:16:01'),
(60, 20, 'Community ', '', '', '', NULL, 4, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:47:49', '2007-10-18 15:23:31'),
(61, 20, 'Religious', '', '', '', NULL, 5, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:48:28', '2007-10-18 15:23:59'),
(62, 20, 'University', '', '', '', NULL, 6, '', NULL, NULL, NULL, NULL, NULL, '2007-09-21 16:48:53', '2007-10-18 15:24:08'),
(63, 22, 'Language of Repository Description', NULL, NULL, NULL, NULL, NULL, 'ISIAH 5.6.7', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 22, 'Script of Repository Description', NULL, NULL, NULL, NULL, NULL, 'ISIAH 5.6.7', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 3, 'Minimal', '', '', '', NULL, 3, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-24 13:48:12', '2007-09-24 13:48:27'),
(66, 3, 'Partial', '', '', '', NULL, 2, 'ISAAR (CPF)', NULL, NULL, NULL, NULL, NULL, '2007-09-24 14:20:44', '2007-09-24 14:20:44'),
(75, 6, 'Afghanistan', NULL, 'AF', 'AFG', 4, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 6, 'Albania', NULL, 'AL', 'ALB', 8, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 6, 'Algeria', NULL, 'DZ', 'DZA', 12, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 6, 'American Samoa', NULL, 'AS', 'ASM', 16, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 6, 'Andorra', NULL, 'AD', 'AND', 20, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 6, 'Angola', NULL, 'AO', 'AGO', 24, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 6, 'Anguilla', NULL, 'AI', 'AIA', 660, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 6, 'Antarctica', NULL, 'AQ', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 6, 'Antigua and Barbuda', NULL, 'AG', 'ATG', 28, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 6, 'Argentina', NULL, 'AR', 'ARG', 32, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 6, 'Armenia', NULL, 'AM', 'ARM', 51, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 6, 'Aruba', NULL, 'AW', 'ABW', 533, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 6, 'Australia', NULL, 'AU', 'AUS', 36, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 6, 'Austria', NULL, 'AT', 'AUT', 40, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 6, 'Azerbaijan', NULL, 'AZ', 'AZE', 31, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 6, 'Bahamas', NULL, 'BS', 'BHS', 44, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 6, 'Bahrain', NULL, 'BH', 'BHR', 48, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 6, 'Bangladesh', NULL, 'BD', 'BGD', 50, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 6, 'Barbados', NULL, 'BB', 'BRB', 52, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 6, 'Belarus', NULL, 'BY', 'BLR', 112, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 6, 'Belgium', NULL, 'BE', 'BEL', 56, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 6, 'Belize', NULL, 'BZ', 'BLZ', 84, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 6, 'Benin', NULL, 'BJ', 'BEN', 204, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 6, 'Bermuda', NULL, 'BM', 'BMU', 60, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 6, 'Bhutan', NULL, 'BT', 'BTN', 64, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 6, 'Bolivia', NULL, 'BO', 'BOL', 68, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 6, 'Bosnia and Herzegovina', NULL, 'BA', 'BIH', 70, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 6, 'Botswana', NULL, 'BW', 'BWA', 72, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 6, 'Bouvet Island', NULL, 'BV', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 6, 'Brazil', NULL, 'BR', 'BRA', 76, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 6, 'British Indian Ocean Territory', NULL, 'IO', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 6, 'Brunei Darussalam', NULL, 'BN', 'BRN', 96, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 6, 'Bulgaria', NULL, 'BG', 'BGR', 100, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 6, 'Burkina Faso', NULL, 'BF', 'BFA', 854, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 6, 'Burundi', NULL, 'BI', 'BDI', 108, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 6, 'Cambodia', NULL, 'KH', 'KHM', 116, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 6, 'Cameroon', NULL, 'CM', 'CMR', 120, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 6, 'Canada', NULL, 'CA', 'CAN', 124, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 6, 'Cape Verde', NULL, 'CV', 'CPV', 132, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 6, 'Cayman Islands', NULL, 'KY', 'CYM', 136, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 6, 'Central African Republic', NULL, 'CF', 'CAF', 140, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 6, 'Chad', NULL, 'TD', 'TCD', 148, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 6, 'Chile', NULL, 'CL', 'CHL', 152, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 6, 'China', NULL, 'CN', 'CHN', 156, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 6, 'Christmas Island', NULL, 'CX', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 6, 'Cocos (Keeling) Islands', NULL, 'CC', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 6, 'Colombia', NULL, 'CO', 'COL', 170, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 6, 'Comoros', NULL, 'KM', 'COM', 174, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 6, 'Congo', NULL, 'CG', 'COG', 178, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 6, 'Congo, the Democratic Republic of the', NULL, 'CD', 'COD', 180, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 6, 'Cook Islands', NULL, 'CK', 'COK', 184, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 6, 'Costa Rica', NULL, 'CR', 'CRI', 188, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 6, 'Cote D''Ivoire', NULL, 'CI', 'CIV', 384, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 6, 'Croatia', NULL, 'HR', 'HRV', 191, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 6, 'Cuba', NULL, 'CU', 'CUB', 192, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 6, 'Cyprus', NULL, 'CY', 'CYP', 196, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 6, 'Czech Republic', NULL, 'CZ', 'CZE', 203, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 6, 'Denmark', NULL, 'DK', 'DNK', 208, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 6, 'Djibouti', NULL, 'DJ', 'DJI', 262, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 6, 'Dominica', NULL, 'DM', 'DMA', 212, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 6, 'Dominican Republic', NULL, 'DO', 'DOM', 214, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 6, 'Ecuador', NULL, 'EC', 'ECU', 218, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 6, 'Egypt', NULL, 'EG', 'EGY', 818, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 6, 'El Salvador', NULL, 'SV', 'SLV', 222, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 6, 'Equatorial Guinea', NULL, 'GQ', 'GNQ', 226, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 6, 'Eritrea', NULL, 'ER', 'ERI', 232, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 6, 'Estonia', NULL, 'EE', 'EST', 233, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 6, 'Ethiopia', NULL, 'ET', 'ETH', 231, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 6, 'Falkland Islands (Malvinas)', NULL, 'FK', 'FLK', 238, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 6, 'Faroe Islands', NULL, 'FO', 'FRO', 234, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 6, 'Fiji', NULL, 'FJ', 'FJI', 242, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 6, 'Finland', NULL, 'FI', 'FIN', 246, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 6, 'France', NULL, 'FR', 'FRA', 250, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 6, 'French Guiana', NULL, 'GF', 'GUF', 254, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 6, 'French Polynesia', NULL, 'PF', 'PYF', 258, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 6, 'French Southern Territories', NULL, 'TF', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 6, 'Gabon', NULL, 'GA', 'GAB', 266, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 6, 'Gambia', NULL, 'GM', 'GMB', 270, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 6, 'Georgia', NULL, 'GE', 'GEO', 268, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 6, 'Germany', NULL, 'DE', 'DEU', 276, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 6, 'Ghana', NULL, 'GH', 'GHA', 288, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 6, 'Gibraltar', NULL, 'GI', 'GIB', 292, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 6, 'Greece', NULL, 'GR', 'GRC', 300, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 6, 'Greenland', NULL, 'GL', 'GRL', 304, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 6, 'Grenada', NULL, 'GD', 'GRD', 308, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 6, 'Guadeloupe', NULL, 'GP', 'GLP', 312, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 6, 'Guam', NULL, 'GU', 'GUM', 316, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 6, 'Guatemala', NULL, 'GT', 'GTM', 320, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 6, 'Guinea', NULL, 'GN', 'GIN', 324, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 6, 'Guinea-Bissau', NULL, 'GW', 'GNB', 624, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 6, 'Guyana', NULL, 'GY', 'GUY', 328, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 6, 'Haiti', NULL, 'HT', 'HTI', 332, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 6, 'Heard Island and Mcdonald Islands', NULL, 'HM', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 6, 'Holy See (Vatican City State)', NULL, 'VA', 'VAT', 336, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 6, 'Honduras', NULL, 'HN', 'HND', 340, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 6, 'Hong Kong', NULL, 'HK', 'HKG', 344, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 6, 'Hungary', NULL, 'HU', 'HUN', 348, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 6, 'Iceland', NULL, 'IS', 'ISL', 352, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 6, 'India', NULL, 'IN', 'IND', 356, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 6, 'Indonesia', NULL, 'ID', 'IDN', 360, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 6, 'Iran, Islamic Republic of', NULL, 'IR', 'IRN', 364, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 6, 'Iraq', NULL, 'IQ', 'IRQ', 368, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 6, 'Ireland', NULL, 'IE', 'IRL', 372, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 6, 'Israel', NULL, 'IL', 'ISR', 376, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 6, 'Italy', NULL, 'IT', 'ITA', 380, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 6, 'Jamaica', NULL, 'JM', 'JAM', 388, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 6, 'Japan', NULL, 'JP', 'JPN', 392, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 6, 'Jordan', NULL, 'JO', 'JOR', 400, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 6, 'Kazakhstan', NULL, 'KZ', 'KAZ', 398, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 6, 'Kenya', NULL, 'KE', 'KEN', 404, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 6, 'Kiribati', NULL, 'KI', 'KIR', 296, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 6, 'Korea, Democratic People''s Republic of', NULL, 'KP', 'PRK', 408, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 6, 'Korea, Republic of', NULL, 'KR', 'KOR', 410, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 6, 'Kuwait', NULL, 'KW', 'KWT', 414, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 6, 'Kyrgyzstan', NULL, 'KG', 'KGZ', 417, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 6, 'Lao People''s Democratic Republic', NULL, 'LA', 'LAO', 418, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, 6, 'Latvia', NULL, 'LV', 'LVA', 428, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 6, 'Lebanon', NULL, 'LB', 'LBN', 422, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 6, 'Lesotho', NULL, 'LS', 'LSO', 426, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 6, 'Liberia', NULL, 'LR', 'LBR', 430, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 6, 'Libyan Arab Jamahiriya', NULL, 'LY', 'LBY', 434, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 6, 'Liechtenstein', NULL, 'LI', 'LIE', 438, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 6, 'Lithuania', NULL, 'LT', 'LTU', 440, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 6, 'Luxembourg', NULL, 'LU', 'LUX', 442, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 6, 'Macao', NULL, 'MO', 'MAC', 446, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 6, 'Macedonia, the Former Yugoslav Republic of', NULL, 'MK', 'MKD', 807, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 6, 'Madagascar', NULL, 'MG', 'MDG', 450, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 6, 'Malawi', NULL, 'MW', 'MWI', 454, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 6, 'Malaysia', NULL, 'MY', 'MYS', 458, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 6, 'Maldives', NULL, 'MV', 'MDV', 462, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 6, 'Mali', NULL, 'ML', 'MLI', 466, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 6, 'Malta', NULL, 'MT', 'MLT', 470, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 6, 'Marshall Islands', NULL, 'MH', 'MHL', 584, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 6, 'Martinique', NULL, 'MQ', 'MTQ', 474, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 6, 'Mauritania', NULL, 'MR', 'MRT', 478, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 6, 'Mauritius', NULL, 'MU', 'MUS', 480, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 6, 'Mayotte', NULL, 'YT', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 6, 'Mexico', NULL, 'MX', 'MEX', 484, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 6, 'Micronesia, Federated States of', NULL, 'FM', 'FSM', 583, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 6, 'Moldova, Republic of', NULL, 'MD', 'MDA', 498, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 6, 'Monaco', NULL, 'MC', 'MCO', 492, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 6, 'Mongolia', NULL, 'MN', 'MNG', 496, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 6, 'Montserrat', NULL, 'MS', 'MSR', 500, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 6, 'Morocco', NULL, 'MA', 'MAR', 504, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 6, 'Mozambique', NULL, 'MZ', 'MOZ', 508, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 6, 'Myanmar', NULL, 'MM', 'MMR', 104, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 6, 'Namibia', NULL, 'NA', 'NAM', 516, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 6, 'Nauru', NULL, 'NR', 'NRU', 520, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 6, 'Nepal', NULL, 'NP', 'NPL', 524, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 6, 'Netherlands', NULL, 'NL', 'NLD', 528, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 6, 'Netherlands Antilles', NULL, 'AN', 'ANT', 530, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 6, 'New Caledonia', NULL, 'NC', 'NCL', 540, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 6, 'New Zealand', NULL, 'NZ', 'NZL', 554, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 6, 'Nicaragua', NULL, 'NI', 'NIC', 558, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 6, 'Niger', NULL, 'NE', 'NER', 562, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 6, 'Nigeria', NULL, 'NG', 'NGA', 566, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 6, 'Niue', NULL, 'NU', 'NIU', 570, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 6, 'Norfolk Island', NULL, 'NF', 'NFK', 574, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 6, 'Northern Mariana Islands', NULL, 'MP', 'MNP', 580, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 6, 'Norway', NULL, 'NO', 'NOR', 578, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 6, 'Oman', NULL, 'OM', 'OMN', 512, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 6, 'Pakistan', NULL, 'PK', 'PAK', 586, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 6, 'Palau', NULL, 'PW', 'PLW', 585, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 6, 'Palestinian Territory, Occupied', NULL, 'PS', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 6, 'Panama', NULL, 'PA', 'PAN', 591, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 6, 'Papua New Guinea', NULL, 'PG', 'PNG', 598, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 6, 'Paraguay', NULL, 'PY', 'PRY', 600, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 6, 'Peru', NULL, 'PE', 'PER', 604, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 6, 'Philippines', NULL, 'PH', 'PHL', 608, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 6, 'Pitcairn', NULL, 'PN', 'PCN', 612, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 6, 'Poland', NULL, 'PL', 'POL', 616, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 6, 'Portugal', NULL, 'PT', 'PRT', 620, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 6, 'Puerto Rico', NULL, 'PR', 'PRI', 630, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 6, 'Qatar', NULL, 'QA', 'QAT', 634, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 6, 'Reunion', NULL, 'RE', 'REU', 638, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 6, 'Romania', NULL, 'RO', 'ROM', 642, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 6, 'Russian Federation', NULL, 'RU', 'RUS', 643, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 6, 'Rwanda', NULL, 'RW', 'RWA', 646, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 6, 'Saint Helena', NULL, 'SH', 'SHN', 654, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 6, 'Saint Kitts and Nevis', NULL, 'KN', 'KNA', 659, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 6, 'Saint Lucia', NULL, 'LC', 'LCA', 662, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 6, 'Saint Pierre and Miquelon', NULL, 'PM', 'SPM', 666, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 6, 'Saint Vincent and the Grenadines', NULL, 'VC', 'VCT', 670, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 6, 'Samoa', NULL, 'WS', 'WSM', 882, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 6, 'San Marino', NULL, 'SM', 'SMR', 674, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 6, 'Sao Tome and Principe', NULL, 'ST', 'STP', 678, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 6, 'Saudi Arabia', NULL, 'SA', 'SAU', 682, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 6, 'Senegal', NULL, 'SN', 'SEN', 686, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 6, 'Serbia and Montenegro', NULL, 'CS', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 6, 'Seychelles', NULL, 'SC', 'SYC', 690, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 6, 'Sierra Leone', NULL, 'SL', 'SLE', 694, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 6, 'Singapore', NULL, 'SG', 'SGP', 702, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 6, 'Slovakia', NULL, 'SK', 'SVK', 703, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 6, 'Slovenia', NULL, 'SI', 'SVN', 705, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 6, 'Solomon Islands', NULL, 'SB', 'SLB', 90, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 6, 'Somalia', NULL, 'SO', 'SOM', 706, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(271, 6, 'South Africa', NULL, 'ZA', 'ZAF', 710, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(272, 6, 'South Georgia and the South Sandwich Islands', NULL, 'GS', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(273, 6, 'Spain', NULL, 'ES', 'ESP', 724, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(274, 6, 'Sri Lanka', NULL, 'LK', 'LKA', 144, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(275, 6, 'Sudan', NULL, 'SD', 'SDN', 736, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 6, 'Suriname', NULL, 'SR', 'SUR', 740, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(277, 6, 'Svalbard and Jan Mayen', NULL, 'SJ', 'SJM', 744, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(278, 6, 'Swaziland', NULL, 'SZ', 'SWZ', 748, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(279, 6, 'Sweden', '', 'SE', 'SWE', 752, 0, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, '2007-06-01 11:37:37'),
(280, 6, 'Switzerland', NULL, 'CH', 'CHE', 756, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 6, 'Syrian Arab Republic', NULL, 'SY', 'SYR', 760, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 6, 'Taiwan, Province of China', NULL, 'TW', 'TWN', 158, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 6, 'Tajikistan', NULL, 'TJ', 'TJK', 762, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 6, 'Tanzania, United Republic of', NULL, 'TZ', 'TZA', 834, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 6, 'Thailand', NULL, 'TH', 'THA', 764, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 6, 'Timor-Leste', NULL, 'TL', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 6, 'Togo', NULL, 'TG', 'TGO', 768, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 6, 'Tokelau', NULL, 'TK', 'TKL', 772, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 6, 'Tonga', NULL, 'TO', 'TON', 776, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 6, 'Trinidad and Tobago', NULL, 'TT', 'TTO', 780, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 6, 'Tunisia', NULL, 'TN', 'TUN', 788, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(292, 6, 'Turkey', NULL, 'TR', 'TUR', 792, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(293, 6, 'Turkmenistan', NULL, 'TM', 'TKM', 795, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 6, 'Turks and Caicos Islands', NULL, 'TC', 'TCA', 796, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(295, 6, 'Tuvalu', NULL, 'TV', 'TUV', 798, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(296, 6, 'Uganda', NULL, 'UG', 'UGA', 800, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(297, 6, 'Ukraine', NULL, 'UA', 'UKR', 804, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 6, 'United Arab Emirates', NULL, 'AE', 'ARE', 784, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 6, 'United Kingdom', NULL, 'GB', 'GBR', 826, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(300, 6, 'United States', NULL, 'US', 'USA', 840, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(301, 6, 'United States Minor Outlying Islands', NULL, 'UM', NULL, NULL, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 6, 'Uruguay', NULL, 'UY', 'URY', 858, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 6, 'Uzbekistan', NULL, 'UZ', 'UZB', 860, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 6, 'Vanuatu', NULL, 'VU', 'VUT', 548, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 6, 'Venezuela', NULL, 'VE', 'VEN', 862, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 6, 'Viet Nam', NULL, 'VN', 'VNM', 704, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 6, 'Virgin Islands, British', NULL, 'VG', 'VGB', 92, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 6, 'Virgin Islands, U.s.', NULL, 'VI', 'VIR', 850, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 6, 'Wallis and Futuna', NULL, 'WF', 'WLF', 876, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 6, 'Western Sahara', NULL, 'EH', 'ESH', 732, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 6, 'Yemen', NULL, 'YE', 'YEM', 887, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 6, 'Zambia', NULL, 'ZM', 'ZMB', 894, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 6, 'Zimbabwe', NULL, 'ZW', 'ZWE', 716, NULL, 'ISO 3166', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 19, 'Title note', '', '', '', NULL, 1, 'ISAD(G) 3.1.2', 1, NULL, NULL, NULL, NULL, '2007-10-02 11:27:08', '2007-10-02 11:28:05'),
(318, 19, 'Maintenance note', '', '', '', NULL, 5, 'ISAAR 5.4.9, ISIAH 5.6.9, ISAF 5.4.9', NULL, NULL, NULL, NULL, NULL, '2007-10-02 11:31:10', '2007-10-02 11:31:10'),
(319, 7, 'Fonds', '', '', '', NULL, 1, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:15:19', '2007-10-02 15:15:19'),
(320, 7, 'Sub-fonds', '', '', '', NULL, 2, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:15:29', '2007-10-02 15:15:29'),
(321, 7, 'Series', '', '', '', NULL, 3, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:15:40', '2007-10-02 15:15:40'),
(322, 7, 'Sub-Series', '', '', '', NULL, 4, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:18:22', '2007-10-02 15:18:41'),
(323, 7, 'File', '', '', '', NULL, 5, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:19:46', '2007-10-02 15:19:46'),
(324, 7, 'Item', '', '', '', NULL, 6, 'ISAD(G) 3.1.4', NULL, NULL, NULL, NULL, NULL, '2007-10-02 15:19:56', '2007-10-02 15:19:56'),
(325, 24, 'archival material', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(326, 24, 'published material', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 12, 'Video', '', '', '', NULL, 4, '', 1, NULL, NULL, NULL, NULL, '2007-10-02 16:09:27', '2007-10-02 16:09:27'),
(331, 12, 'Text', '', '', '', NULL, 1, '', NULL, NULL, NULL, NULL, NULL, '2007-10-02 16:17:07', '2007-10-02 16:17:07'),
(332, 12, 'Image', '', '', '', NULL, 2, '', NULL, NULL, NULL, NULL, NULL, '2007-10-02 16:17:15', '2007-10-02 16:17:15'),
(333, 12, 'Audio', '', '', '', NULL, 3, '', NULL, NULL, NULL, NULL, NULL, '2007-10-02 16:17:23', '2007-10-02 16:17:23'),
(334, 25, 'Script of Information Object Description', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 25, 'Language of Information Object Description', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 25, 'Subject Access Point', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(337, 25, 'Place Access Point', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 26, 'creation', 'created', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 26, 'custody', 'took custody', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 26, 'publication', 'published', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(344, 2, 'Creator', 'created', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(345, 2, 'Custodian', 'had custody', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 14, 'Local government', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2007-10-18 13:33:00', '2007-10-18 13:33:00'),
(347, 14, 'Vancouver, British Columbia', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2007-10-18 13:33:20', '2007-10-18 13:33:20'),
(348, 18, 'Previous name', '', '', '', NULL, 4, '', NULL, NULL, NULL, NULL, NULL, '2007-10-18 14:27:32', '2007-10-18 15:19:31'),
(349, 18, 'Other name', '', '', '', NULL, 3, 'ISAAR (CPF) 5.1.5', NULL, NULL, NULL, NULL, NULL, '2007-10-18 15:18:51', '2007-10-18 15:21:53'),
(350, 20, 'Municipal', '', '', '', NULL, 7, '', NULL, NULL, NULL, NULL, NULL, '2007-10-18 15:22:59', '2007-10-18 15:23:18'),
(351, 14, 'Architectural records', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2007-10-18 17:16:31', '2007-10-18 17:16:31'),
(352, 26, 'existence', 'existed', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 14, 'Zoo', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2007-10-23 15:56:28', '2007-10-23 15:56:28');

-- 
-- Dumping data for table `term_recursive_relationship`
-- 


-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`id`, `user_name`, `email`, `sha1_password`, `salt`, `actor_id`, `created_at`, `updated_at`) VALUES (1, 'default admin', 'admin@ica-atom.org', '301f96a59f916a527db584a178afef3dd9655766', '99f7032b89159227c713c1d99233773c', NULL, NULL, '2007-10-23 14:08:21'),
(6, 'default editor', 'editor@ica-atom.org', '53ffb0d3737947c68ecf909c049725fb7c848aab', '9c18cd7992fdca2e611f1e474f5a3f0e', NULL, '2007-09-13 15:51:51', '2007-10-23 14:08:31'),
(7, 'default contributor', 'contributor@ica-atom.org', '295f4d264d7650a61c1c47f3824d85cad831de7e', 'be29c1435c1cfa83dec264010cecd7e8', NULL, '2007-09-13 15:54:23', '2007-10-23 14:08:49');

-- 
-- Dumping data for table `user_term_relationship`
-- 

INSERT INTO `user_term_relationship` (`id`, `user_id`, `term_id`, `relationship_type_id`, `repository_id`, `description`, `created_at`, `updated_at`) VALUES (1, 1, 5, 6, NULL, NULL, NULL, NULL),
(19, 6, 3, 6, NULL, NULL, '2007-09-13 15:51:52', '2007-09-13 15:51:52'),
(20, 7, 2, 6, NULL, NULL, '2007-09-13 15:54:23', '2007-09-13 15:54:23');

SET FOREIGN_KEY_CHECKS=1;
