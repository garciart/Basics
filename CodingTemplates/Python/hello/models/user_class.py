#!python
# -*- coding: utf-8 -*-

"""
User class.

Python version used: 3.6.8
SQLite version used: 3.21.0

Styling guide: PEP 8 -- Style Guide for Python Code
    (https://www.python.org/dev/peps/pep-0008/) and
    PEP 257 -- Docstring Conventions
    (https://www.python.org/dev/peps/pep-0257/)
"""

from __future__ import print_function

from model import common_functions as co

# Module metadata dunders
__author__ = "Rob Garcia"
__copyright__ = "Copyright 2019-2020, Rob Garcia"
__email__ = "rgarcia@rgprogramming.com"
__license__ = "MIT"


class User:
    """User class. Uses @property instead of getters and setters."""

    @property
    def user_id(self):
        """User ID getter.

        :return: The user ID property.
        :rtype: int
        """
        return self.__user_id

    @user_id.setter
    def user_id(self, user_id):
        """User ID setter.

        :param user_id: The user's ID.
        :type user_id: int
        :raises ValueError: if user_id is empty, 0, NULL, or FALSE.
        """
        if not co.validate_user_id(user_id):
            raise ValueError("User ID cannot be empty, 0, NULL, or FALSE.")
        self.__user_id = int(user_id)

    @property
    def first_name(self):
        """First name getter.

        :return: The first name property.
        :rtype: int
        """
        return self.__first_name

    @first_name.setter
    def first_name(self, first_name):
        """First name setter.

        :param first_name: The user's first name.
        :type first_name: str
        :raises ValueError: if first_name is not an alphanumeric string.
        """
        first_name = first_name.strip()
        if not co.validate_text(first_name):
            raise ValueError(
                "First name cannot be empty or contain illegal characters.")
        self.__first_name = first_name

    @property
    def last_name(self):
        """Last name getter.

        :return: The last name property.
        :rtype: int
        """
        return self.__last_name

    @last_name.setter
    def last_name(self, last_name):
        """Last name setter.

        :param last_name: The user's last name.
        :type last_name: str
        :raises ValueError: if last_name is not an alphanumeric string.
        """
        last_name = last_name.strip()
        if not co.validate_text(last_name):
            raise ValueError("Last name cannot be empty"
                             "or contain illegal characters.")
        self.__last_name = last_name

    @property
    def email(self):
        """Email getter.

        :return: The email property.
        :rtype: str
        """
        return self.__email

    @email.setter
    def email(self, email):
        """Email setter.

        :param email: The user's email address (can be used as a user name).
        :type email: str
        :raises ValueError: if email is empty, incorrectly formatted,
                            or contains illegal characters.
        """
        email = email.strip()
        if not co.validate_email(email):
            raise ValueError("Email cannot be empty, incorrectly formatted,"
                             "or contain illegal characters.")
        self.__email = email

    @property
    def score(self):
        """Score getter.

        :return: The score property.
        :rtype: float
        """
        return self.__score

    @score.setter
    def score(self, score):
        """Score setter.

        :param score: The user's score from 0.0 to 100.0.
        :type score: float
        :raises ValueError: if score is not equal to or between 0.0 and 100.0.
        """
        if not score or score < 0.0 or score > 100.0:
            raise ValueError(
                "Score cannot be empty and must be equal to or between 0.0 and 100.0."
            )
        self.__score = score

    @property
    def creation_date(self):
        """Creation date getter.

        :return: The creation date property.
        :rtype: str
        """
        return self.__creation_date

    @creation_date.setter
    def creation_date(self, creation_date):
        """Creation date setter.

        :param creation_date: The date the user was added to the database.
        :type creation_date: str
        :raises ValueError: if creation_date is empty or incorrectly formatted.
        """
        if not co.validate_date(creation_date):
            raise ValueError(
                "Creation date cannot be empty or incorrectly formatted.")
        self.__creation_date = creation_date

    @property
    def comment(self):
        """Comment getter.

        :return: The comment property.
        :rtype: str
        """
        return self.__comment

    @comment.setter
    def comment(self, comment):
        """Comment setter.

        :param comment: Any additional comments.
        :type comment: str
        """
        self.__comment = comment

    def __init__(self, user_id, first_name, last_name, email, score,
                 creation_date, comment):
        """Updates a user's information in the database.

        :param self: The instance of the class object.
        :type self: object
        :param user_id: The user's ID.
        :type user_id: int
        :param first_name: The user's first name.
        :type first_name: str
        :param last_name: The user's last name.
        :type last_name: str
        :param email: The user's email address.
        :type email: str
        :param score: The user's score from 0.0 to 100.0.
        :type score: float
        :param creation_date: The date the user was added to the database.
        :type creation_date: str
        :param comment: Any additional comments.
        :type comment: str
        :return: The number of rows affected. A value other than 1
                 indicates an error.
        :rtype: int
        """
        self.user_id = user_id
        self.first_name = first_name
        self.last_name = last_name
        self.email = email
        self.score = score
        self.creation_date = creation_date
        self.comment = comment
