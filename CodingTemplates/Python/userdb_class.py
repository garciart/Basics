#!python
# -*- coding: utf-8 -*-

'''
User database class. Handles all interactions with the User database.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import datetime
import os
import sqlite3
import sys

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
        try:
            # Removed Pathlib (redundant) and needed to set PWD to correct
            # directory using os
            os.chdir(common.ROOT_DIR)
            if not os.path.isdir('./db'):
                os.makedirs('db')
            if not os.path.exists('./db/user.db'):
                self.create_user_table()
                self.create_user(
                    'Rob', 'Garcia', 'rgarcia@rgprogramming.com',
                    100, 'Administrator.')
                self.create_user(
                    'George', 'Washington', 'gwashington@rgprogramming.com',
                    100, 'Old user.')
                self.create_user(
                    'Baby', 'Yoda', 'byoda@rgprogramming.com',
                    100, 'New user.')
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)

    def create_user_table(self):
        try:
            conn = self.connect()
            cursor = conn.cursor()
            sql = """ CREATE TABLE IF NOT EXISTS User (
                UserID integer PRIMARY KEY,
                FirstName text NOT NULL,
                LastName text NOT NULL,
                Email text UNIQUE NOT NULL,
                Score real NOT NULL DEFAULT '100.0',
                CreateDate string NOT NULL,
                Comment text
            ); """
            cursor.execute(sql)
            conn.commit()
            cursor.close()
            conn.close()
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)

    def create_user(self, first_name, last_name, email, score, comment):
        try:
            # Set other initial values
            user_id = self.get_next_user_id()
            local_timezone = datetime.datetime.now(
                datetime.timezone.utc).astimezone().tzinfo
            create_date = datetime.datetime.now(
                local_timezone).strftime("%Y-%m-%d %H:%M:%S")
            conn = self.connect()
            cursor = conn.cursor()
            sql = ''' INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?); '''
            data = (user_id, first_name, last_name,
                    email, score, create_date, comment)
            cursor.execute(sql, data)
            conn.commit()
            last_row_id = cursor.lastrowid
            cursor.close()
            conn.close()
            return last_row_id
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)

    def get_all_users(self):
        try:
            conn = self.connect()
            cursor = conn.cursor()
            sql = ''' SELECT *
                FROM User
                ORDER BY LastName ASC; '''
            cursor.execute(sql)
            result = cursor.fetchall()
            cursor.close()
            conn.close()
            return result
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)

    def get_next_user_id(self):
        try:
            conn = self.connect()
            cursor = conn.cursor()
            sql = 'SELECT MAX(UserID) as LastUserID FROM User;'
            cursor.execute(sql)
            row = cursor.fetchone()
            cursor.close()
            conn.close()
            last_user_id = 0 if row['LastUserID'] is \
                None else row['LastUserID']
            # Add 1 to the last user ID
            return last_user_id + 1
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)

    def connect(self):
        conn = None
        try:
            conn = sqlite3.connect('db/user.db')
            # Use this to get objects by their column names
            # instead of their column indexes
            conn.row_factory = sqlite3.Row
            return conn
        except:
            ex = common.error_log(sys.exc_info())
            if common.display_errors: print(ex)
