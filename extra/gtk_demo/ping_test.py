#!python3
# -*- coding: utf-8 -*-

import os


def main():
    try:
        response = os.system("ping 192.168.100.124")
        if response == 0:
            print("Yay! We connected.")
        else:
            print("Wah! We didn't connect.")
    except Exception as ex:
        print("Oops! Something went wrong!")


if __name__ == "__main__":
    print("Hello, friend.")
    main()
