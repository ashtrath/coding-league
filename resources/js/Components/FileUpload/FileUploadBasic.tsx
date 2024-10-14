import { FileUploadRootProps } from '@ark-ui/react/file-upload';
import {
    RiDeleteBin6Line,
    RiInformationLine,
    RiUploadCloud2Line,
} from '@remixicon/react';
import Button from '../UI/Button';
import {
    FileUpload,
    FileUploadDropzone,
    FileUploadHiddenInput,
    FileUploadItem,
    FileUploadItemDeleteTrigger,
    FileUploadItemGroup,
    FileUploadItemName,
    FileUploadItemPreview,
    FileUploadItemPreviewImage,
    FileUploadItemSizeText,
    FileUploadLabel,
} from '../UI/FileUpload';

const FileUploadBasic = ({ maxFiles = 1, ...props }: FileUploadRootProps) => {
    const acceptedFormats = props.accept
        ? Object.values(props.accept)
              .flat()
              .map((ext) => ext.replace('.', '').toUpperCase())
              .join(', ')
        : 'Any';

    return (
        <FileUpload maxFiles={maxFiles} {...props}>
            <FileUploadDropzone>
                <div className="size-fit rounded-full border-[6px] border-red-100 bg-red-200 p-2 text-brand">
                    <RiUploadCloud2Line className="size-5" />
                </div>
                <div className="space-y-1 text-center *:block">
                    <FileUploadLabel>
                        <span className="font-semibold text-brand">
                            Klik untuk unggah
                        </span>{' '}
                        atau seret dan lepas kesini
                    </FileUploadLabel>
                    <FileUploadLabel>
                        {acceptedFormats}{' '}
                        {props.maxFileSize &&
                            `up to ${(props.maxFileSize / (1024 * 1024)).toFixed(0)} MB`}
                    </FileUploadLabel>
                </div>
            </FileUploadDropzone>
            <FileUploadItemGroup className="mt-4">
                {({ acceptedFiles }) =>
                    acceptedFiles.map((file) => (
                        <FileUploadItem key={file.name} file={file}>
                            {file.type.startsWith('image/') ? (
                                <FileUploadItemPreview type="image/*">
                                    <FileUploadItemPreviewImage />
                                </FileUploadItemPreview>
                            ) : (
                                <FileUploadItemPreview type=".*">
                                    <div className="size-fit rounded-full border-[6px] border-green-100 bg-green-200 p-2 text-gray-900">
                                        <RiInformationLine className="size-6" />
                                    </div>
                                </FileUploadItemPreview>
                            )}
                            <div className="flex-1">
                                <FileUploadItemName />
                                <FileUploadItemSizeText />
                            </div>
                            <FileUploadItemDeleteTrigger
                                className="self-start"
                                asChild
                            >
                                <Button
                                    variant="ghost"
                                    size="icon"
                                    className="self-start"
                                >
                                    <RiDeleteBin6Line className="size-5" />
                                </Button>
                            </FileUploadItemDeleteTrigger>
                        </FileUploadItem>
                    ))
                }
            </FileUploadItemGroup>
            <FileUploadHiddenInput data-testid="input" />
        </FileUpload>
    );
};

export default FileUploadBasic;
