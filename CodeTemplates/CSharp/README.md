# Hello, World! (C# Template)

This is a basic C# console application, which includes some of the most common C# keywords, functions, and methods from the C# Platform, Standard Edition (C# SE) application programming interface (API). For portability and simplicity, it uses the SQLite relational database management system (RDBMS) and demonstrates how to:

- Access a module from another module.
- Create, read, update, and delete data from a database.
- Validate numbers and formated text, such as email addresses.
- Instantiate class objects.
- Handle and log exceptions and errors.
- Run unit tests.
- Apply styling and comments per the [.NET Core Engineering guidelines](https://github.com/dotnet/aspnetcore/wiki/Engineering-guidelines#coding-guidelines) and [C# Programming Guide](https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/inside-a-program/coding-conventions).

Before starting, ensure the following applications are installed:

- .NET Core 3.1.0
- C# version 8.0
- System.Data.SQLite.Core 1.0.112.0
- nunit 3.12.0
- NUnit3TestAdapter 3.16.1
- Microsoft.NET.Test.Sdk 16.5.0

Initialize from repo directory (i.e., CodeTemplates):

    dotnet new console -o CSharp
    cd CSharp
    dotnet add package System.Data.SQLite.Core
    dotnet add package nunit
    dotnet add package NUnit3TestAdapter
    dotnet add package Microsoft.NET.Test.Sdk

Add *\<GenerateProgramFile\>false\</GenerateProgramFile\>* to **\<PropertyGroup\>** in CSharp.csproj file

This template uses a very simple directory structure that can be incorporated into Maven or Gradle:

    CSharp
    |-- Hello
        |-- bin
        |-- Data
            |-- Users.db
        |-- Models
            |-- CommonFunctions.cs
            |-- DatabaseFunctions.cs
            |-- User.cs
        |-- obj
        |-- Hello.csproj
        |-- ErrorLog.txt
        |-- Program.cs
    |-- Tests
        |-- Tests.csproj
        |-- CommonFunctionTest.cs
    |-- .gitignore
    |-- LICENSE
    |-- README.MD

To run from terminal, make sure you are in the project directory  (i.e., CSharp) and run the following command:

    dotnet run --project ./Hello

To run tests, make sure you are in the project directory  (i.e., CSharp) and run the following commands:

    dotnet restore ./Tests
    dotnet test ./Tests
