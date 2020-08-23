import os


def main():
    path = r"C:\Users\Rob\OneDrive\Documents\Certifications\CompTIA Security\gibson"
    for filename in os.listdir(path):
        new_filename = ""
        if filename.find("Review") is not -1:
            new_filename = filename.replace("Review", "a_Review")
        elif filename.find("Remember") is not -1:
            new_filename = filename.replace("Remember", "b_Remember")
        elif filename.find("Q&A") is not -1:
            new_filename = filename.replace("Q&A", "c_QA")
        os.rename(filename, new_filename)
        print(path + "\\" + filename, path + "\\" + new_filename)


if __name__ == '__main__':
    main()
