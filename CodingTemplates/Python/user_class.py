#!python
# -*- coding: utf-8 -*-

'''
User class.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import common

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'


class User:
    # Class fields
    _user_id = ''
    _first_name = ''
    _last_name = ''
    _email = ''
    _score = 0.0
    _create_date = ''
    _comment = ''

    def __init__(self, user_id, first_name, last_name, email, score,
                 create_date, comment):
        self._user_id = user_id
        self._first_name = first_name
        self._last_name = last_name
        self._email = email
        self._score = score
        self._create_date = create_date
        self._comment = comment

    @property
    def user_id(self):
        return self._user_id

    @user_id.setter
    def user_id(self, user_id):
        self._user_id = user_id

    @property
    def first_name(self):
        return self._first_name

    @first_name.setter
    def first_name(self, user_id):
        self._first_name = first_name

    @property
    def last_name(self):
        return self._last_name

    @last_name.setter
    def last_name(self, last_name):
        self._last_name = last_name

    @property
    def email(self):
        return self._email

    @email.setter
    def email(self, email):
        self._email = email

    @property
    def score(self):
        return self._score

    @score.setter
    def score(self, score):
        self._score = score

    @property
    def create_date(self):
        return self._create_date

    @create_date.setter
    def create_date(self, create_date):
        self._create_date = create_date

    @property
    def comment(self):
        return self._comment

    @comment.setter
    def comment(self, comment):
        self._comment = comment
