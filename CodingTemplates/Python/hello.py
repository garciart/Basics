#!python
# -*- coding: utf-8 -*-

'''
Hello World in Python with database integration.

Python version used: 3.6.8
SQLite version used: 3.21.0

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import sys

import common as co
import database_functions as db
import user_class as uc

# Module metadata dunders
__author__ = 'Rob Garcia'
__copyright__ = 'Copyright 2018-2019, Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'
__package__ = 'Python'


def hello_users():
    '''
    Test database calls, class instantiation, and validation.
    '''
    try:
        # Task 1: Connect and retrieve information from the database
        result = db.get_all_users()
        if result is not None:
            list_of_users = []

            for row in result:
                list_of_users.append(uc.User(
                    row['UserID'], row['FirstName'], row['LastName'], row['Email'],
                    row['Score'], row['CreationDate'], row['Comment']))

            print("Number of users in the database: {}".format(len(list_of_users)))
            print("The first user is {}.\n".format(
                list_of_users[0].first_name))

            for index, user in enumerate(list_of_users):
                print("Hello, {} {}! You are #{}, created on {}, "
                      "and you are a(n) {}".format(
                          user.first_name, user.last_name, index + 1,
                          user.creation_date, user.comment))

            print()

            # Task 2: Add, update, and delete a new user
            thanos = []

            if db.user_exists(['thanos@rgprogramming.com']):
                print("Thanos, you are already in the database!\n")
                result = db.get_user_by_email(['thanos@rgprogramming.com'])
                if result is None:
                    raise Exception('Cannot retrieve user data!')
                else:
                    # Use asterisk to unpack tuple into class
                    thanos = uc.User(*result)
            else:
                user_id = db.create_user(
                    'Thanos', 'The Mad Titan', 'thanos@rgprogramming.com', 100,
                    'Unbalanced user.')
                if user_id == 0:
                    raise Exception('Cannot create user!')
                else:
                    result = db.get_user_by_user_id(user_id)
                    if result is None:
                        raise Exception('Cannot retrieve user data!')
                    else:
                        # Use asterisk to unpack tuple into class
                        thanos = uc.User(*result)
                        print("Welcome {} {}! You were created on {} "
                              "and you are a(n) {}\n".format(
                                  thanos.first_name, thanos.last_name,
                                  thanos.creation_date, thanos.comment))

            if thanos.comment == 'Unbalanced user.':
                print("Uh oh, Thanos, you are unbalanced! Let's fix that!\n")
                thanos.comment = 'Balanced user.'
                if db.update_user(
                        thanos.user_id, thanos.first_name, thanos.last_name,
                        thanos.email, thanos.score, thanos.comment) == 1:
                    print("Ahh...perfectly balanced. As all things should be.\n")
                else:
                    print("Can't be balanced! Should've gone for the head!\n")
            else:
                thanos.comment = 'Unbalanced user.'
                if db.update_user(
                        thanos.user_id, thanos.first_name, thanos.last_name,
                        thanos.email, thanos.score, thanos.comment) == 1:
                    print("Thanos, you've become unbalanced!\n")
                else:
                    print("Can't be unbalanced! Should've gone for the head!\n")

            print("Sorry, Thanos; I am Iron Man, and you've got to go!\n")

            if db.delete_user(thanos.user_id) == 1:
                print('Destiny fulfilled.')
            else:
                print('Thanos cannot be deleted; he is inevitable!')
        else:
            print("No records were found.")
    except Exception:
        ex = co.error_log(sys.exc_info())
        if co.DISPLAY_ERRORS:
            print(ex)
        else:
            print('Unable to connect to the database and retrieve data. '
                  'Check the error log for details.')


def main():
    '''
    Application entry point.
    '''
    print("Hello, World!\n")
    hello_users()


if __name__ == '__main__':
    main()
