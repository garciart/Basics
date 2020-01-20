#!python
# -*- coding: utf-8 -*-

'''
Hello World in Python with database integration.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import datetime
from pathlib import Path

import common
import user_class
import userdb_class

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'


def hello_users():
    try:
        user_db = userdb_class.UserDB()
        result = user_db.get_all_users()
        for row in result:
            user = user_class.User(row['UserID'], row['FirstName'], row['LastName'], row['Email'], row['Score'], row['CreateDate'], row['Comment'])
            print("Hello {} {}! {}".format(row['FirstName'], row['LastName'], row['CreateDate']))
    except:
        print('Unable to connect to the database and retrieve data.')


def main():
    print('Hello, World!')
    hello_users()


if __name__ == '__main__':
    main()
