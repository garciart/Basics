#!python
# -*- coding: utf-8 -*-

'''
Hello World in Python with database integration.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import datetime
import sys

import common
import db
import user_class

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'


def hello_users():
    '''
    Test database calls and class instantiation
    '''
    try:
        # Task 1: Create a set of users from the database
        list_of_users = []
        result = db.get_all_users()
        for row in result:
            list_of_users.append(user_class.User(
                row['UserID'], row['FirstName'], row['LastName'], row['Email'],
                row['Score'], row['CreateDate'], row['Comment']))

        # Task 2: Retrieve user information from a list of users
        print('Number of users: {}'.format(len(list_of_users)))
        print('The first user is {}.'.format(list_of_users[0].first_name))
        for index, user in enumerate(list_of_users):
            print('Hello, {} {}! You are User {}, created on {}.'.format(
                user.first_name, user.last_name, index + 1, user.create_date))
    except:
        ex = common.error_log(sys.exc_info())
        print(ex) if common.display_errors else print(
            'Unable to connect to the database and retrieve data. '
            'Check the error log for details.')


def main():
    print('Hello, World!')
    hello_users()


if __name__ == '__main__':
    main()
