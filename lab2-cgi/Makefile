TARGET = hello.cgi

TESTS = QueryParametersTests

CXX = clang++
CXXFLAGS = -std=c++17 -Wall -Wno-c++11-inline-namespace -Wno-c++11-extensions
CC = clang++

$(TARGET): main.o app.o QueryParameters.o
	$(CC) -o $(TARGET) $?

$(TESTS): QueryParameters.o QueryParametersTests.o

main.o: app.h
app.o: app.h QueryParameters.h
QueryParameters.o: QueryParameters.h

QueryParametersTests.o: QueryParameters.h
	$(CXX) $(CXXFLAGS) -c QueryParametersTests.cpp -I .

test: $(TESTS)
	./$(TESTS)

clean:
	rm -f $(TARGET) $(TESTS) *.o

install: $(TARGET)
	cp $(TARGET) ~/my-projects/WebDev/sites/cgi/