#!python
# -*- coding: utf-8 -*-

"""
Unit tests using unittest.

Python version used: 3.6.8
SQLite version used: 3.21.0

Styling guide: PEP 8 -- Style Guide for Python Code
    (https://www.python.org/dev/peps/pep-0008/) and
    PEP 257 -- Docstring Conventions
    (https://www.python.org/dev/peps/pep-0257/)
"""

from __future__ import print_function

import os
import sys
import unittest

# Add the folder with the files to be tested to the Python path at runtime
ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
sys.path.insert(1, ROOT_DIR + os.path.sep + "hello")

# Import the files to be tested
from models import common_functions as co


# Module metadata dunders
__author__ = "Rob Garcia"
__copyright__ = "Copyright 2019-2020, Rob Garcia"
__email__ = "rgarcia@rgprogramming.com"
__license__ = "MIT"


class TestCommonFunctions(unittest.TestCase):
    """Unit tests.

    :param unittest: Python unit testing framework
    :type unittest: module
    """

    def test_validate_user_id_false(self):
        """
        Test that the method rejects values less than or equal to 0.
        """
        arg = -1
        result = co.validate_user_id(arg)
        self.assertFalse(result)

    def test_validate_user_id_true(self):
        """
        Test that the method accepts values greater than 0.
        """
        arg = 1
        result = co.validate_user_id(arg)
        self.assertTrue(result)

    def test_validate_user_id_exception(self):
        """
        Test that the method raises an exception/error due to invalid input.
        """
        arg = "a"
        with self.assertRaises(Exception):
            co.validate_user_id(arg)

    def test_validate_text_false(self):
        """
        Test that the method rejects values with invalid characters.
        """
        arg = "<script>alert('This is an injection!');</script>"
        result = co.validate_text(arg)
        self.assertFalse(result)

    def test_validate_text_true(self):
        """
        Test that the method accepts values with valid characters.
        """
        arg = "Robert"
        result = co.validate_text(arg)
        self.assertTrue(result)

    def test_validate_text_exception(self):
        """
        Test that the method raises an exception/error due to invalid input.
        """
        arg = -1
        with self.assertRaises(Exception):
            co.validate_text(arg)

    def test_validate_email_false(self):
        """
        Test that the method rejects values with illegal characters or
        in incorrect format.
        """
        arg = "<script>alert('This is an injection!');</script>"
        result = co.validate_email(arg)
        self.assertFalse(result)

    def test_validate_email_true(self):
        """
        Test that the method accepts values with legal characters and
        in correct format.
        """
        arg = "rgarcia@rgprogramming.com"
        result = co.validate_email(arg)
        self.assertTrue(result)

    def test_validate_email_exception(self):
        """
        Test that the method raises an exception/error due to invalid input.
        """
        arg = -1
        with self.assertRaises(Exception):
            co.validate_email(arg)

    def test_validate_date_false(self):
        """
        Test that the method rejects values with illegal characters or
        in incorrect format.
        """
        arg = "<script>alert('This is an injection!');</script>"
        result = co.validate_date(arg)
        self.assertFalse(result)

    def test_validate_date_true(self):
        """
        Test that the method accepts values with legal characters and
        in correct format.
        """
        arg = "2020-02-02 12:00:00"
        result = co.validate_date(arg)
        self.assertTrue(result)

    def test_validate_date_exception(self):
        """
        Test that the method raises an exception/error due to invalid input.
        """
        arg = -1
        with self.assertRaises(Exception):
            co.validate_date(arg)


if __name__ == '__main__':
    unittest.main()
