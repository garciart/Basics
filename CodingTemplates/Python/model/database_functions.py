#!python
# -*- coding: utf-8 -*-

"""
Database module. Handles all calls to the User database.

Python version used: 3.6.8
SQLite version used: 3.21.0

Styling guide: PEP 8 -- Style Guide for Python Code
    (https://www.python.org/dev/peps/pep-0008/) and
    PEP 257 -- Docstring Conventions
    (https://www.python.org/dev/peps/pep-0257/)
"""

from __future__ import print_function

import datetime
import os
import sqlite3
import sys

from model import common_functions as co

# Module metadata dunders
__author__ = 'Rob Garcia'
__copyright__ = 'Copyright 2019-2020, Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'
__package__ = 'Python'

"""
Module functions:
    int create_user_table()
    int create_user(first_name, last_name, email, score, comment)
    list get_all_users()
    tuple get_user_by_user_id(user_id)
    tuple get_user_by_email(email)
    int update_user(user_id, first_name, last_name, email, score, comment)
    int delete_user(user_id)
    int get_next_user_id()
    bool user_exists(email)
    conn connect()
    bool database_exists()
"""


def create_user_table():
    """Creates the User table if it does not exist in the database.

    :returns: The number of rows affected. In Python, both DROP and
        CREATE will return -1.
    :rtype: int
    """
    rows_affected = -1
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = """DROP TABLE IF EXISTS User;"""
        cursor.execute(sql)
        conn.commit()
        rows_affected = cursor.rowcount
        print(cursor.rowcount)
        sql = """
        CREATE TABLE IF NOT EXISTS User (
            UserID integer PRIMARY KEY,
            FirstName text NOT NULL,
            LastName text NOT NULL,
            Email text UNIQUE NOT NULL,
            Score real NOT NULL DEFAULT '100.0',
            CreationDate text NOT NULL,
            Comment text
        ); """
        cursor.execute(sql)
        conn.commit()
        rows_affected = cursor.rowcount
        print(cursor.rowcount)
        cursor.close()
        conn.close()
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)
    print("Create table: {}.".format(rows_affected))
    return rows_affected


def create_user(first_name, last_name, email, score, comment):
    """Inserts a new user into the database.

    :param first_name: The user's first name.
    :type first_name: str
    :param last_name: The user's last name.
    :type last_name: str
    :param email: The user's email address (can be used as a user name).
    :type email: str
    :param score: The user's score from 0.0 to 100.0.
    :type score: float
    :param comment: Any additional comments.
    :type comment: str
    :returns: The rowid of the new user. A value of 0 indicates an error.
    :rtype: int
    """
    last_row_id = 0
    try:
        # Set other initial values
        user_id = get_next_user_id()
        local_timezone = datetime.datetime.now(
            datetime.timezone.utc).astimezone().tzinfo
        creation_date = datetime.datetime.now(
            local_timezone).strftime("%Y-%m-%d %H:%M:%S")
        conn = connect()
        cursor = conn.cursor()
        sql = 'INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?);'
        data = (str(user_id), first_name, last_name,
                email, str(score), creation_date, comment)
        cursor.execute(sql, data)
        conn.commit()
        last_row_id = cursor.lastrowid
        cursor.close()
        conn.close()
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)
    print("Create user: {}.".format(last_row_id))
    return last_row_id


def get_all_users():
    """Gets all the users in the database and their information.

    :returns: A list of all the users in the database and their
        information. An empty list indicates an error.
    :rtype: list
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = 'SELECT * FROM User ORDER BY UserID ASC;'
        cursor.execute(sql)
        result = cursor.fetchall()
        cursor.close()
        conn.close()
        return result
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def get_user_by_user_id(user_id):
    """Returns a single user and his or her information.

    :param user_id: The user's ID.
    :type user_id: int
    :returns: The user's information indexed by column name or empty
        if the user's ID is not found.
    :rtype: tuple
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = 'SELECT * FROM User WHERE UserID = ?'
        cursor.execute(sql, str(user_id))
        result = cursor.fetchone()
        cursor.close()
        conn.close()
        return result
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def get_user_by_email(email):
    """Returns a single user and his or her information.

    :param email: The user's email.
    :type email: str
    :returns: The user's information indexed by column name or empty
        if the user's email is not found.
    :rtype: tuple
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = 'SELECT * FROM User WHERE Email = ?'
        cursor.execute(sql, email)
        result = cursor.fetchone()
        cursor.close()
        conn.close()
        return result
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def update_user(user_id, first_name, last_name, email, score, comment):
    """Updates a user's information in the database.

    :param user_id: The user's ID.
    :type user_id: int
    :param first_name: The user's first name.
    :type first_name: str
    :param last_name: The user's last name.
    :type last_name: str
    :param email: The user's email address (can be used as a user name).
    :type email: str
    :param score: The user's score from 0.0 to 100.0.
    :type score: float
    :param comment: Any additional comments.
    :type comment: str
    return: The number of rows affected. A value other than 1 indicates
        an error.
    :rtype: int
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = """
        UPDATE User 
        SET FirstName = ?,
            LastName = ?,
            Email = ?,
            Score = ?,
            Comment = ?
        WHERE UserID = ? """
        data = (first_name, last_name, email, str(score), comment,
                str(user_id))
        cursor.execute(sql, data)
        conn.commit()
        row_count = cursor.rowcount
        cursor.close()
        conn.close()
        return row_count
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def delete_user(user_id):
    """Deletes a user from the database.

    :param user_id: The user's ID.
    :type user_id: int
    :returns: The number of rows affected. A value other than 1
        indicates an error.
    :rtype: int
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = 'DELETE FROM User WHERE UserID = ?;'
        cursor.execute(sql, str(user_id))
        conn.commit()
        row_count = cursor.rowcount
        cursor.close()
        conn.close()
        return row_count
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def get_next_user_id():
    """Gets the anticipated value of the next UserID (usually the last row
        inserted) from the User table.

    :returns: The value of the next UserID or 0 if there is no data.
    :rtype: int
    """
    try:
        conn = connect()
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
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def user_exists(email):
    """Checks if the given users exists in the database.
        Julen Pardo came up with this.
        Thought about changing the method to retrieve the UserID instead,
        but Email is supposed to be unique.
        If the count != 1, that means there are no users or more than one,
        which means something is wrong. This is a better method.

    :param email: The email to check.
    :type email: str
    :returns: True if the users exists, False if not.
    :rtype: bool
    """
    try:
        conn = connect()
        cursor = conn.cursor()
        sql = 'SELECT COUNT(*) AS Count FROM User WHERE Email = ?;'
        cursor.execute(sql, email)
        result = cursor.fetchone()
        exists = (result['Count'] == 1)
        cursor.close()
        conn.close()
        return exists
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def connect():
    """Connects to the database.

    :returns: The connection to the SQLite database
    :rtype: object
    """
    conn = None
    try:
        conn = sqlite3.connect('db/user.db')
        # Use this to get objects by their column names
        # instead of their column indexes
        conn.row_factory = sqlite3.Row
        return conn
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)


def database_exists():
    """Create and populate the database if it does not exists.

    :return: True if the database exists or was created, false if not
    :rtype: bool
    """
    exists = False
    try:
        # Removed Pathlib (redundant) and needed to set PWD to correct
        # directory using os
        os.chdir(co.MODEL_DIR)
        if not os.path.isdir('./db') or not os.path.exists('./db/user.db'):
            os.makedirs('db', exist_ok=True)
            if create_user_table() != -1: exists = False
            if create_user(
                'Rob', 'Garcia', 'rgarcia@rgprogramming.com',
                80.0, 'Administrator.') == 0: exists = False
            if create_user(
                'George', 'Washington', 'gwashington@rgprogramming.com',
                90.0, 'Old user.') == 0: exists = False
            if create_user(
                'Baby', 'Yoda', 'byoda@rgprogramming.com',
                100.0, 'New user.') == 0: exists = False
        else:
            exists = True
    # Use MODULE_EX to prevent overwriting function internal exceptions (ex)
    except Exception:
        MODULE_EX = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(MODULE_EX)
    return exists
