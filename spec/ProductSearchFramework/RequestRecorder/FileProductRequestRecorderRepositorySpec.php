<?php
namespace spec\ProductSearchFramework\RequestRecorder;

use League\Flysystem\FilesystemInterface;
use PhpSpec\ObjectBehavior;
use ProductSearch\RequestRecorder\ProductRequestRecorderRepository;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\RequestRecorder\FileProductRequestRecorderRepository
 */
class FileProductRequestRecorderRepositorySpec extends ObjectBehavior
{
    const FILE_NAME = 'path/to/file';

    public function let(FilesystemInterface $filesystem)
    {
        $this->beConstructedWith($filesystem, self::FILE_NAME);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\RequestRecorder\FileProductRequestRecorderRepository::class);
    }

    public function it_should_implement_request_recorder_repository()
    {
        $this->shouldHaveType(ProductRequestRecorderRepository::class);
    }

    public function it_should_create_a_new_file_and_return_empty_content_on_file_not_exist(
        FilesystemInterface $filesystem
    ) {
        $content = '';
        $filesystem->has(self::FILE_NAME)->willReturn(false);
        $filesystem->write(self::FILE_NAME, Argument::type('string'))->shouldBeCalled();
        $filesystem->read(self::FILE_NAME)->willReturn($content);

        $this->read()->shouldReturn($content);
    }

    public function it_should_read_existing_file_and_return_its_content_on_file_exists(
        FilesystemInterface $filesystem
    ) {
        $content = 'File Content';
        $filesystem->has(self::FILE_NAME)->willReturn(true);
        $filesystem->write(self::FILE_NAME, Argument::type('string'))->shouldNotBeCalled();
        $filesystem->read(self::FILE_NAME)->willReturn($content);

        $this->read()->shouldReturn($content);
    }

    public function it_should_write_content(FilesystemInterface $filesystem)
    {
        $content = 'File Content';

        $filesystem->write(self::FILE_NAME, $content)->shouldBeCalled();

        $this->write($content);
;    }
}
