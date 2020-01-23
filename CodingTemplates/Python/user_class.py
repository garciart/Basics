#!python
# -*- coding: utf-8 -*-

'''
User class.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import common as co

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'


class User:
    '''
    User class. Uses @property instead of getters and setters.
    '''

    # Class methods
    def __init__(self, user_id, first_name, last_name, email, score,
                 creation_date, comment):
        '''
        Updates a user's information in the database.
        :param object self: The instance of the class object.
        :param int user_id: The user's ID.
        :param str first_name: The user's first name.
        :param str last_name: The user's last name.
        :param str email: The user's email address (used for user name).
        :param float score: The user's score from 0.0 to 100.0.
        :param str creation_date: The date the user was added to the database.
        :param str comment: Any additional comments.
        return int: The number of rows affected. A value other than 1
                    indicates an error.
        '''
        self.user_id = user_id
        self.first_name = first_name
        self.last_name = last_name
        self.email = email
        self.score = score
        self.creation_date = creation_date
        self.comment = comment

    @property
    def user_id(self):
        '''Gets/Sets user ID, verifying it is an integer.'''
        return self.__user_id

    @user_id.setter
    def user_id(self, user_id):
        if not co.validateUserID(user_id):
            raise ValueError('User ID cannot be empty, 0, NULL, or FALSE.')
        self.__user_id = int(user_id)

    @property
    def first_name(self):
        '''Gets/Sets first name, verifying it is an alphanumeric string.'''
        return self.__first_name

    @first_name.setter
    def first_name(self, first_name):
        first_name = first_name.strip()
        if not co.validateText(first_name):
            raise ValueError(
                'First name cannot be empty or contain illegal characters.')
        self.__first_name = first_name

    @property
    def last_name(self):
        '''Gets/Sets last name, verifying it is an alphanumeric string.'''
        return self.__last_name

    @last_name.setter
    def last_name(self, last_name):
        last_name = last_name.strip()
        if not co.validateText(last_name):
            raise ValueError('Last name cannot be empty'
                             'or contain illegal characters.')
        self.__last_name = last_name

    @property
    def email(self):
        '''Gets/Sets email, verifying it is a valid email address.'''
        return self.__email

    @email.setter
    def email(self, email):
        email = email.strip()
        if not co.validateEmail(email):
            raise ValueError('Email cannot be empty, incorrectly formatted,'
                             'or contain illegal characters.')
        self.__email = email

    @property
    def score(self):
        '''Gets/Sets score, verifying it is between 0.0 and 100.0.'''
        return self.__score

    @score.setter
    def score(self, score):
        if not score or score < 0.0 or score > 100.0:
            raise ValueError(
                'Score cannot be empty and must be equal to or between 0.0 and 100.0'
            )
        self.__score = score

    @property
    def creation_date(self):
        '''Gets/Sets creation date, verifying it is valid and formatted.'''
        return self.__creation_date

    @creation_date.setter
    def creation_date(self, creation_date):
        if not co.validateDate(creation_date):
            raise ValueError(
                'Creation date cannot be empty or incorrectly formatted.')
        self.__creation_date = creation_date

    @property
    def comment(self):
        '''Gets/Sets comments: no validation necessary.'''
        return self.__comment

    @comment.setter
    def comment(self, comment):
        self.__comment = comment
