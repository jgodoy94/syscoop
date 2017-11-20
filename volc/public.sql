/*
Navicat PGSQL Data Transfer

Source Server         : local10
Source Server Version : 100100
Source Host           : localhost:5432
Source Database       : coopsysdeb
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 100100
File Encoding         : 65001

Date: 2017-11-19 23:45:04
*/


-- ----------------------------
-- Table structure for lbtelpme
-- ----------------------------
DROP TABLE IF EXISTS "public"."lbtelpme";
CREATE TABLE "public"."lbtelpme" (
"elpmedi" int8 NOT NULL,
"mena" varchar(100) COLLATE "default" NOT NULL,
"elpmedeco" int8 NOT NULL,
"ograc" varchar(255) COLLATE "default" NOT NULL,
"livicest" varchar(255) COLLATE "default" NOT NULL,
"cancef" date NOT NULL,
"tuocef" date,
"nicef" date NOT NULL,
"mido" varchar(255) COLLATE "default" NOT NULL,
"ulec" int8 NOT NULL,
"jofi" int8,
"est" bool NOT NULL,
"oiralas" numeric NOT NULL,
"referper" int8 NOT NULL,
"referfam" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for lbtrefer
-- ----------------------------
DROP TABLE IF EXISTS "public"."lbtrefer";
CREATE TABLE "public"."lbtrefer" (
"referdi" int8 NOT NULL,
"refermena" varchar(50) COLLATE "default" NOT NULL,
"refermido" varchar(255) COLLATE "default" NOT NULL,
"referulec" int8 NOT NULL,
"referjofi" int8,
"refercod" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for lbtresus
-- ----------------------------
DROP TABLE IF EXISTS "public"."lbtresus";
CREATE TABLE "public"."lbtresus" (
"resudi" int8 NOT NULL,
"resu" varchar(50) COLLATE "default" NOT NULL,
"ssap" varchar(50) COLLATE "default" NOT NULL,
"vipri" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for lbtserp
-- ----------------------------
DROP TABLE IF EXISTS "public"."lbtserp";
CREATE TABLE "public"."lbtserp" (
"serpdi" int8 NOT NULL,
"tomon" numeric NOT NULL,
"liso" int8 NOT NULL,
"satouc" int8 NOT NULL,
"serpest" bool NOT NULL,
"gapnac" numeric NOT NULL,
"etnitot" numeric NOT NULL,
"roirp" int2 NOT NULL,
"elpmedi" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for lbttacuen
-- ----------------------------
DROP TABLE IF EXISTS "public"."lbttacuen";
CREATE TABLE "public"."lbttacuen" (
"tacudi" int8 NOT NULL,
"tomon" money NOT NULL,
"elpmedi" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table lbtelpme
-- ----------------------------
ALTER TABLE "public"."lbtelpme" ADD PRIMARY KEY ("elpmedi");

-- ----------------------------
-- Primary Key structure for table lbtrefer
-- ----------------------------
ALTER TABLE "public"."lbtrefer" ADD PRIMARY KEY ("referdi");

-- ----------------------------
-- Primary Key structure for table lbtresus
-- ----------------------------
ALTER TABLE "public"."lbtresus" ADD PRIMARY KEY ("resudi");

-- ----------------------------
-- Primary Key structure for table lbtserp
-- ----------------------------
ALTER TABLE "public"."lbtserp" ADD PRIMARY KEY ("serpdi", "liso");

-- ----------------------------
-- Primary Key structure for table lbttacuen
-- ----------------------------
ALTER TABLE "public"."lbttacuen" ADD PRIMARY KEY ("tacudi");

-- ----------------------------
-- Foreign Key structure for table "public"."lbtelpme"
-- ----------------------------
ALTER TABLE "public"."lbtelpme" ADD FOREIGN KEY ("referper") REFERENCES "public"."lbtrefer" ("referdi") ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE "public"."lbtelpme" ADD FOREIGN KEY ("referfam") REFERENCES "public"."lbtrefer" ("referdi") ON DELETE NO ACTION ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."lbtserp"
-- ----------------------------
ALTER TABLE "public"."lbtserp" ADD FOREIGN KEY ("elpmedi") REFERENCES "public"."lbtelpme" ("elpmedi") ON DELETE NO ACTION ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."lbttacuen"
-- ----------------------------
ALTER TABLE "public"."lbttacuen" ADD FOREIGN KEY ("elpmedi") REFERENCES "public"."lbtelpme" ("elpmedi") ON DELETE NO ACTION ON UPDATE CASCADE;
