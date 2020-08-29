# python3 mclip.py hello

import sys

TEST = {"agree": "Yes, I agree. That sounds fine to me.",
        "busy": "Sorry, can we do this later this week or next week?",
        "upsell": "Would you consider making this a monthly donation"}


def main(keyphrase):
    try:
        print(keyphrase)
    except Exception as ex:
        print("Oops! Something went wrong:", ex)


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python mclip.py [keyphrase] - copy phrase text")
        sys.exit()
    else:
        main(sys.argv[1])
