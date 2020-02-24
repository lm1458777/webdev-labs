TARGET = hello.cgi
CC = clang++
CFLAGS = -std=c++17 -Wall -Wno-c++11-inline-namespace -Wno-c++11-extensions

$(TARGET): hello.o QueryStringParser.o
	$(CC) hello.o QueryStringParser.o -o $(TARGET)

hello.o: hello.cpp QueryStringParser.h
	$(CC) -c hello.cpp $(CFLAGS)

QueryStringParser.o: QueryStringParser.cpp QueryStringParser.h
	$(CC) -c QueryStringParser.cpp $(CFLAGS)

test: QueryStringParserTests.cpp QueryStringParser.h QueryStringParser.o
	$(CC) QueryStringParserTests.cpp QueryStringParser.o -o QueryStringParserTests $(CFLAGS) -I .
	./QueryStringParserTests

clean:
	rm -f $(TARGET)
	rm -f *.o

install: $(TARGET)
	cp $(TARGET) ~/my-projects/WebDev/sites/cgi/