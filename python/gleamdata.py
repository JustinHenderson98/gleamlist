class data(object):
    def __init__(self, url, title, end):
        self.url = url
        self.title = title
        self.end = end

    def __iter__(self):
        for each in self.__dict__.keys():
            yield self.__getattribute__(each)

    def get_url(self):
        return self.url

    def get_title(self):
        return self.title

    def get_end(self):
        return self.end
