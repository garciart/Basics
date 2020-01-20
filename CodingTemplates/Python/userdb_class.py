#!python
# -*- coding: utf-8 -*-

'''
User database class. Handles all interactions with the User database using PDO.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import datetime
import os
import sqlite3
from pathlib import Path
from sqlite3 import Error

import common

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'

# Class methods:
# __init__
# create_user_table()
# create_user(first_name, last_name, email, score, comment)
# get_all_users()
# * getUserByUserID($userID)
# * getUserByEmail($email)
# * updateUser($userID, $firstName, $lastName, $email, $score, $comment)
# * deleteUser($userID)
# get_next_user_id()
# * userExists($email)
# connect()


class UserDB:

    def __init__(self):
        # Needed to set PWD to correct directory
        os.chdir(common.ROOT_DIR)
        try:
            if not os.path.exists('db/user.db'):
                self.create_user_table()
                self.create_user('Rob', 'Garcia', 'rgarcia@rgprogramming.com', 100, 'Administrator.')
                self.create_user('George', 'Washington', 'gwashington@rgprogramming.com', 100, 'Old user.')
                self.create_user('Baby', 'Yoda', 'byoda@rgprogramming.com', 100, 'New user.')
        except Error as ex:
            print("Error: {}".format(ex))

    def create_user_table(self):
        try:
            conn = self.connect()
            sql = """ CREATE TABLE IF NOT EXISTS User (
                UserID integer PRIMARY KEY,
                FirstName text NOT NULL,
                LastName text NOT NULL,
                Email text UNIQUE NOT NULL,
                Score real NOT NULL DEFAULT '100.0',
                CreateDate string NOT NULL,
                Comment text
            ); """
            cursor = conn.cursor()
            cursor.execute(sql)
            conn.commit()
        except Error as ex:
            print("Error: {}".format(ex))

    def create_user(self, first_name, last_name, email, score, comment):
        try:
            user_id = self.get_next_user_id()
            conn = self.connect()
            sql = ''' INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?); '''
            local_timezone = datetime.datetime.now(
                datetime.timezone.utc).astimezone().tzinfo
            create_date = datetime.datetime.now(
                local_timezone).strftime("%Y-%m-%d %H:%M:%S")
            data = (user_id, first_name, last_name, email, score, create_date, comment)
            cursor = conn.cursor()
            cursor.execute(sql, data)
            conn.commit()
            return cursor.lastrowid
        except Error as ex:
            print("Error: {}".format(ex))

    def get_all_users(self):
        try:
            conn = self.connect()
            sql = ''' SELECT *
                FROM User
                ORDER BY LastName ASC; '''
            cursor = conn.cursor()
            cursor.execute(sql)
            result = cursor.fetchall()
            return result
        except Error as ex:
            print("Error: {}".format(ex))

    def get_next_user_id(self):
        try:
            conn = self.connect()
            sql = 'SELECT MAX(UserID) as LastUserID FROM User;'
            cursor = conn.cursor()
            cursor.execute(sql)
            row = cursor.fetchone()
            last_user_id = 0 if row['LastUserID'] is None else row['LastUserID']
            # Add 1 to the last user ID
            return last_user_id + 1
        except Error as ex:
            print("Error: {}".format(ex))

    def connect(self):
        conn = None
        try:
            # conn = sqlite3.connect('user.db')
            conn = sqlite3.connect('db/user.db')
            conn.row_factory = sqlite3.Row
            return conn
        except Error as ex:
            print("Error: {}".format(ex))
